# API Testing Examples

Use these cURL commands to test the API directly from your terminal.

## Health Check

```bash
curl http://localhost:8000/api/health
```

## Authentication

### Register New User
```bash
curl -X POST http://localhost:8000/api/register \
  -H "Content-Type: application/json" \
  -d '{
    "name": "Test User",
    "email": "test@example.com",
    "password": "password",
    "password_confirmation": "password",
    "phone": "1234567890",
    "address": "123 Test Street"
  }'
```

### Login
```bash
curl -X POST http://localhost:8000/api/login \
  -H "Content-Type: application/json" \
  -d '{
    "email": "admin@restaurant.com",
    "password": "password"
  }'
```

**Save the token from the response!**

### Get Current User
```bash
curl http://localhost:8000/api/me \
  -H "Authorization: Bearer YOUR_TOKEN_HERE"
```

### Logout
```bash
curl -X POST http://localhost:8000/api/logout \
  -H "Authorization: Bearer YOUR_TOKEN_HERE"
```

## Categories

### Get All Categories
```bash
curl http://localhost:8000/api/categories
```

### Get Category by Slug
```bash
curl http://localhost:8000/api/categories/pizza
```

### Create Category (Admin Only)
```bash
curl -X POST http://localhost:8000/api/categories \
  -H "Content-Type: application/json" \
  -H "Authorization: Bearer YOUR_ADMIN_TOKEN" \
  -d '{
    "name": "Desserts",
    "description": "Sweet treats and desserts",
    "is_active": true
  }'
```

## Menu Items

### Get All Menu Items
```bash
curl http://localhost:8000/api/menu-items
```

### Get Featured Items
```bash
curl "http://localhost:8000/api/menu-items?featured=true"
```

### Get Items by Category
```bash
curl "http://localhost:8000/api/menu-items?category_id=1"
```

### Search Items
```bash
curl "http://localhost:8000/api/menu-items?search=pizza"
```

### Get Single Menu Item
```bash
curl http://localhost:8000/api/menu-items/margherita-pizza
```

### Create Menu Item (Admin Only)
```bash
curl -X POST http://localhost:8000/api/menu-items \
  -H "Content-Type: application/json" \
  -H "Authorization: Bearer YOUR_ADMIN_TOKEN" \
  -d '{
    "category_id": 1,
    "name": "Veggie Pizza",
    "description": "Loaded with fresh vegetables",
    "price": 13.99,
    "is_available": true,
    "is_featured": false,
    "preparation_time": 20,
    "ingredients": ["Tomato", "Onion", "Peppers", "Mushrooms"]
  }'
```

## Orders

### Get My Orders
```bash
curl http://localhost:8000/api/orders \
  -H "Authorization: Bearer YOUR_TOKEN"
```

### Get Orders by Status
```bash
curl "http://localhost:8000/api/orders?status=pending" \
  -H "Authorization: Bearer YOUR_TOKEN"
```

### Create Order
```bash
curl -X POST http://localhost:8000/api/orders \
  -H "Content-Type: application/json" \
  -H "Authorization: Bearer YOUR_TOKEN" \
  -d '{
    "items": [
      {
        "menu_item_id": 1,
        "quantity": 2,
        "special_instructions": "Extra cheese please"
      },
      {
        "menu_item_id": 3,
        "quantity": 1
      }
    ],
    "delivery_address": "123 Main Street, City, State 12345",
    "customer_phone": "1234567890",
    "payment_method": "cash",
    "notes": "Please ring doorbell"
  }'
```

### Get Single Order
```bash
curl http://localhost:8000/api/orders/1 \
  -H "Authorization: Bearer YOUR_TOKEN"
```

### Update Order Status (Admin Only)
```bash
curl -X PUT http://localhost:8000/api/orders/1/status \
  -H "Content-Type: application/json" \
  -H "Authorization: Bearer YOUR_ADMIN_TOKEN" \
  -d '{
    "status": "confirmed"
  }'
```

**Available Statuses:**
- pending
- confirmed
- preparing
- ready
- delivered
- cancelled

### Cancel Order
```bash
curl -X POST http://localhost:8000/api/orders/1/cancel \
  -H "Authorization: Bearer YOUR_TOKEN"
```

---

## PowerShell Examples (Windows)

If you're on Windows, use these PowerShell commands:

### Login
```powershell
$body = @{
    email = "admin@restaurant.com"
    password = "password"
} | ConvertTo-Json

Invoke-RestMethod -Uri "http://localhost:8000/api/login" `
  -Method Post `
  -Body $body `
  -ContentType "application/json"
```

### Get Menu Items
```powershell
Invoke-RestMethod -Uri "http://localhost:8000/api/menu-items"
```

### Create Order
```powershell
$token = "YOUR_TOKEN_HERE"

$body = @{
    items = @(
        @{
            menu_item_id = 1
            quantity = 2
        }
    )
    delivery_address = "123 Main St"
    customer_phone = "1234567890"
    payment_method = "cash"
} | ConvertTo-Json

$headers = @{
    "Authorization" = "Bearer $token"
    "Content-Type" = "application/json"
}

Invoke-RestMethod -Uri "http://localhost:8000/api/orders" `
  -Method Post `
  -Headers $headers `
  -Body $body
```

---

## Testing Tips

1. **Save your token**: After login, save the token to use in subsequent requests
2. **Use Postman**: Import the `postman_collection.json` for easier testing
3. **Check responses**: All responses include a `success` field and optional `message`
4. **Admin vs Customer**: Some endpoints require admin role
5. **Error handling**: Failed requests return appropriate HTTP status codes

---

## Common Response Codes

- `200` - Success
- `201` - Created (for POST requests)
- `400` - Bad Request (validation failed)
- `401` - Unauthorized (not logged in or invalid token)
- `403` - Forbidden (not enough permissions)
- `404` - Not Found
- `500` - Server Error
