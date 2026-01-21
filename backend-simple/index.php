<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Authorization');
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}

// Database configuration
$host = 'localhost';
$dbname = 'restaurant';
$username = 'root';
$password = '';

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

// REGISTER/LOGIN ENDPOINT - handle both /api/register and /register
if (($uri === '/api/register' || $uri === '/register') && $method === 'POST') {
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
        
        $stmt = $pdo->prepare("INSERT INTO users (email, password, created_at, updated_at) VALUES (?, ?, NOW(), NOW())");
        $stmt->execute([$email, $hashedPassword]);
        
        $userId = $pdo->lastInsertId();
        $token = bin2hex(random_bytes(32));
        
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
    $address = $input['delivery_address'] ?? '';
    $phone = $input['delivery_phone'] ?? '';
    $items = $input['items'] ?? [];
    
    if (empty($address) || empty($phone) || empty($items)) {
        echo json_encode(['success' => false, 'message' => 'Missing required fields']);
        exit;
    }
    
    // Calculate totals
    $subtotal = 0;
    foreach ($items as $item) {
        $stmt = $pdo->prepare("SELECT price FROM menu_items WHERE slug = ?");
        $stmt->execute([$item['slug']]);
        $menuItem = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($menuItem) {
            $subtotal += $menuItem['price'] * $item['quantity'];
        }
    }
    
    $deliveryFee = 1000;
    $total = $subtotal + $deliveryFee;
    $orderNumber = 'ORD-' . strtoupper(substr(md5(time()), 0, 8));
    
    // Create order
    $stmt = $pdo->prepare("INSERT INTO orders (user_id, order_number, status, payment_status, payment_method, subtotal, delivery_fee, total, delivery_address, delivery_phone, notes, created_at, updated_at) VALUES (1, ?, 'pending', 'paid', 'online', ?, ?, ?, ?, ?, 'Order from website', NOW(), NOW())");
    $stmt->execute([$orderNumber, $subtotal, $deliveryFee, $total, $address, $phone]);
    
    $orderId = $pdo->lastInsertId();
    
    // Create order items
    foreach ($items as $item) {
        $stmt = $pdo->prepare("SELECT id, name, price FROM menu_items WHERE slug = ?");
        $stmt->execute([$item['slug']]);
        $menuItem = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($menuItem) {
            $stmt = $pdo->prepare("INSERT INTO order_items (order_id, menu_item_id, item_name, quantity, price, created_at, updated_at) VALUES (?, ?, ?, ?, ?, NOW(), NOW())");
            $stmt->execute([$orderId, $menuItem['id'], $menuItem['name'], $item['quantity'], $menuItem['price']]);
        }
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
