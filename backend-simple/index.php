<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Authorization');
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}

// Simple .env loader
if (file_exists(__DIR__ . '/.env')) {
    $lines = file(__DIR__ . '/.env', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        if (strpos(trim($line), '#') === 0) continue;
        list($name, $value) = explode('=', $line, 2);
        $_ENV[trim($name)] = trim($value);
        putenv(trim($name) . "=" . trim($value));
    }
}

// Database configuration with falling back to defaults if .env isn't used
$host = getenv('DB_HOST') ?: 'localhost';
$dbname = getenv('DB_NAME') ?: 'restaurant';
$username = getenv('DB_USER') ?: 'root';
$password = getenv('DB_PASS') ?: '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo json_encode(['success' => false, 'message' => 'Database connection failed: ' . $e->getMessage()]);
    exit;
}

// Simple router
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = str_replace('/food-order-school-proj/backend-simple', '', $uri);
$uri = str_replace('/index.php', '', $uri);
$uri = rtrim($uri, '/');
if (empty($uri)) $uri = '/';
$method = $_SERVER['REQUEST_METHOD'];

// Get JSON input
$input = json_decode(file_get_contents('php://input'), true) ?? [];

// Debug output - check what URI we're getting
if (isset($_GET['debug'])) {
    echo json_encode([
        'uri' => $uri,
        'method' => $method,
        'input' => $input,
        'raw_uri' => $_SERVER['REQUEST_URI']
    ]);
    exit;
}

// Helper to get user from token
function getUserFromToken($pdo) {
    $authHeader = null;
    
    if (isset($_SERVER['HTTP_AUTHORIZATION'])) {
        $authHeader = $_SERVER['HTTP_AUTHORIZATION'];
    } elseif (isset($_SERVER['REDIRECT_HTTP_AUTHORIZATION'])) {
        $authHeader = $_SERVER['REDIRECT_HTTP_AUTHORIZATION'];
    } elseif (function_exists('apache_request_headers')) {
        $headers = apache_request_headers();
        if (isset($headers['Authorization'])) {
            $authHeader = $headers['Authorization'];
        }
    }

    if (!$authHeader) {
        return null;
    }
    
    if (preg_match('/Bearer\s(\S+)/', $authHeader, $matches)) {
        $token = $matches[1];
        $stmt = $pdo->prepare("SELECT id FROM users WHERE api_token = ?");
        $stmt->execute([$token]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        return $user ? $user['id'] : null;
    }
    return null;
}

// REGISTER/LOGIN ENDPOINT - handle both /api/register, /register, /login, /api/login
if (($uri === '/api/register' || $uri === '/register' || $uri === '/login' || $uri === '/api/login') && $method === 'POST') {
    $email = $input['email'] ?? '';
    $password = $input['password'] ?? '';
    
    if (empty($email) || empty($password)) {
        echo json_encode(['success' => false, 'message' => 'Email and password are required']);
        exit;
    }
    
    // Check if user exists
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if ($user) {
        // Login
        if (password_verify($password, $user['password'])) {
            $token = bin2hex(random_bytes(32));
            
            // Save token
            $stmt = $pdo->prepare("UPDATE users SET api_token = ? WHERE id = ?");
            $stmt->execute([$token, $user['id']]);
            
            echo json_encode([
                'success' => true,
                'message' => 'Welcome back!',
                'data' => [
                    'user' => [
                        'id' => $user['id'],
                        'email' => $user['email']
                    ],
                    'token' => $token,
                    'token_type' => 'Bearer'
                ]
            ]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Invalid credentials for this email.']);
        }
    } else {
        // Register new user
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $token = bin2hex(random_bytes(32));
        
        $stmt = $pdo->prepare("INSERT INTO users (email, password, api_token, created_at, updated_at) VALUES (?, ?, ?, NOW(), NOW())");
        $stmt->execute([$email, $hashedPassword, $token]);
        
        $userId = $pdo->lastInsertId();
        
        echo json_encode([
            'success' => true,
            'message' => 'Account created successfully!',
            'data' => [
                'user' => [
                    'id' => $userId,
                    'email' => $email
                ],
                'token' => $token,
                'token_type' => 'Bearer'
            ]
        ]);
    }
    exit;
}

// PLACE ORDER ENDPOINT - handle both /api/orders and /orders
if (($uri === '/api/orders' || $uri === '/orders') && $method === 'POST') {
    // Authenticate User
    $userId = getUserFromToken($pdo);
    if (!$userId) {
        echo json_encode(['success' => false, 'message' => 'Unauthorized. Please login first.']);
        exit;
    }

    $address = $input['delivery_address'] ?? '';
    $phone = $input['delivery_phone'] ?? '';
    $items = $input['items'] ?? [];
    
    if (empty($address) || empty($phone) || empty($items)) {
        echo json_encode(['success' => false, 'message' => 'Missing required fields']);
        exit;
    }
    
    // 1. Validate items and calculate totals first
    $subtotal = 0;
    $preparedItems = []; // Store valid items to avoid re-querying

    foreach ($items as $item) {
        $stmt = $pdo->prepare("SELECT id, name, price FROM menu_items WHERE slug = ?");
        $stmt->execute([$item['slug']]);
        $menuItem = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($menuItem) {
            $quantity = (int)$item['quantity'];
            if ($quantity < 1) $quantity = 1;

            $lineTotal = $menuItem['price'] * $quantity;
            $subtotal += $lineTotal;

            // Save for the insertion step
            $preparedItems[] = [
                'id' => $menuItem['id'],
                'name' => $menuItem['name'],
                'price' => $menuItem['price'],
                'quantity' => $quantity
            ];
        }
    }

    $deliveryFee = 1000;
    $total = $subtotal + $deliveryFee;
    $orderNumber = 'ORD-' . strtoupper(substr(md5(time()), 0, 8));

    // 2. Create the Order
    $stmt = $pdo->prepare("INSERT INTO orders (user_id, order_number, status, payment_status, payment_method, subtotal, delivery_fee, total, delivery_address, delivery_phone, notes, created_at, updated_at) VALUES (?, ?, 'confirmed', 'paid', 'online', ?, ?, ?, ?, ?, 'Order from website', NOW(), NOW())");
    $stmt->execute([$userId, $orderNumber, $subtotal, $deliveryFee, $total, $address, $phone]);
    
    $orderId = $pdo->lastInsertId();
    
    // 3. Create Order Items (using the data we already fetched)
    $stmtItem = $pdo->prepare("INSERT INTO order_items (order_id, menu_item_id, item_name, quantity, price, created_at, updated_at) VALUES (?, ?, ?, ?, ?, NOW(), NOW())");
    
    foreach ($preparedItems as $pItem) {
        $stmtItem->execute([$orderId, $pItem['id'], $pItem['name'], $pItem['quantity'], $pItem['price']]);
    }
    
    echo json_encode([
        'success' => true,
        'message' => 'Order placed successfully',
        'data' => [
            'order_number' => $orderNumber,
            'total' => $total
        ]
    ]);
    exit;
}

echo json_encode(['success' => false, 'message' => 'Endpoint not found']);
