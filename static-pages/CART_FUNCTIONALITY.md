# Shopping Cart Functionality - Implementation Guide

## Overview
The shopping cart system has been fully implemented using JavaScript and localStorage to persist cart data across page refreshes and navigation.

## Features Implemented

### 1. Add to Cart
- **Location**: Home page (`home.php`) and Menu page (`menu.php`)
- **Functionality**: Click "Add to Cart" button on any product card
- **Behavior**: 
  - Adds item to cart or increments quantity if already exists
  - Shows animated notification confirming addition
  - Updates cart badge count in header

### 2. Cart Badge
- **Location**: Header (visible on all pages)
- **Functionality**: Displays total number of items in cart
- **Behavior**: Automatically updates when items are added/removed

### 3. Cart Page Management
- **Location**: Cart page (`cart.php`)
- **Functionality**:
  - **Increase Quantity**: Click "+" button
  - **Decrease Quantity**: Click "-" button (prompts for removal if quantity is 1)
  - **Remove All**: Click "Remove All" button to clear entire cart
  - **Dynamic Rendering**: Cart items are loaded from localStorage and displayed dynamically
  - **Auto-calculate Totals**: Subtotal, shipping, and total are calculated automatically

### 4. Data Persistence
- **Technology**: localStorage
- **Key**: `cameroonian_cart`
- **Data Structure**: Array of cart items with properties:
  ```javascript
  {
    id: string,        // Unique identifier
    name: string,      // Product name
    price: number,     // Product price
    image: string,     // Product image path
    quantity: number,  // Quantity in cart
    category: string   // Product category
  }
  ```

## Files Created

### JavaScript Files
1. **`js/cart-manager.js`** - Core cart management class
   - Handles all cart operations (add, update, remove, clear)
   - Manages localStorage persistence
   - Updates cart badge
   - Shows notifications

2. **`js/product-cart.js`** - Product page handler
   - Handles "Add to Cart" button clicks
   - Extracts product data from DOM
   - Calls cart manager to add items

3. **`js/cart-page.js`** - Cart page handler
   - Renders cart items dynamically
   - Handles quantity increase/decrease
   - Calculates and updates totals
   - Manages empty cart state

## CSS Updates
Added cart notification and badge styles to:
- `index.css`
- `cart.css`
- `menu.css`

## HTML Updates
1. **`components/header.php`**
   - Added cart badge span to cart icon
   - Included cart-manager.js script
   - Added cart badge initialization

2. **`pages/home.php`**
   - Added product-cart.js script

3. **`pages/menu.php`**
   - Added product-cart.js script

4. **`pages/cart.php`**
   - Added cart-page.js script

## How It Works

### Adding Items to Cart
1. User clicks "Add to Cart" button
2. Product data is extracted from the card
3. CartManager checks if item exists in cart
4. If exists, quantity is incremented; if not, item is added
5. Cart is saved to localStorage
6. Notification is shown
7. Cart badge is updated

### Managing Cart
1. Cart page loads
2. Cart items are retrieved from localStorage
3. Items are rendered dynamically in the table
4. User can increase/decrease quantities
5. Changes are immediately saved to localStorage
6. Totals are recalculated automatically

### Quantity Controls
- **Increase (+)**: Adds 1 to quantity
- **Decrease (-)**: 
  - If quantity > 1: Subtracts 1
  - If quantity = 1: Prompts for confirmation to remove item

## Testing the Functionality

1. **Test Add to Cart**:
   - Go to Home or Menu page
   - Click "Add to Cart" on any product
   - Check for notification
   - Verify badge count increases

2. **Test Cart Page**:
   - Navigate to cart page
   - Verify items are displayed
   - Test increase/decrease buttons
   - Verify totals update correctly

3. **Test Persistence**:
   - Add items to cart
   - Refresh the page
   - Verify items remain in cart

4. **Test Remove All**:
   - Click "Remove All" button
   - Confirm the action
   - Verify cart is empty

## Browser Compatibility
- Works in all modern browsers that support:
  - localStorage
  - ES6 JavaScript
  - jQuery 3.7.1

## Future Enhancements
- Add product variants (size, options)
- Implement coupon code functionality
- Add wishlist feature
- Integrate with backend for checkout
- Add cart item removal button (individual items)
