<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Cart;
use App\Models\Coupon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $query = Order::where('user_id', $request->user()->id)
            ->with(['items.menuItem', 'user']);

        if ($request->has('status')) {
            $query->where('status', $request->status);
        }

        $orders = $query->orderBy('created_at', 'desc')->get();

        return response()->json([
            'success' => true,
            'data' => $orders
        ]);
    }

    public function show(Request $request, $id)
    {
        $order = Order::where('user_id', $request->user()->id)
            ->where('id', $id)
            ->with(['items.menuItem', 'user'])
            ->first();

        if (!$order) {
            return response()->json([
                'success' => false,
                'message' => 'Order not found'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $order
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'delivery_address' => 'required|string',
            'delivery_phone' => 'required|string',
            'payment_method' => 'required|in:cash,card,online',
            'notes' => 'nullable|string',
            'coupon_code' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $user = $request->user();
        $cartItems = Cart::where('user_id', $user->id)->with('menuItem')->get();

        // If DB cart is empty, check if items were sent in the request
        if ($cartItems->isEmpty() && $request->has('items')) {
            $requestItems = $request->items; // Expecting array of {slug: string, quantity: int}
            $preparedItems = [];
            
            foreach ($requestItems as $item) {
                $menuItem = MenuItem::where('slug', $item['slug'])->first();
                if ($menuItem) {
                    $preparedItems[] = (object)[
                        'menuItem' => $menuItem,
                        'quantity' => $item['quantity'],
                        'menu_item_id' => $menuItem->id,
                        'special_instructions' => $item['special_instructions'] ?? null
                    ];
                }
            }
            $cartItems = collect($preparedItems);
        }

        if ($cartItems->isEmpty()) {
            return response()->json([
                'success' => false,
                'message' => 'Your cart is empty. Please add items before checking out.'
            ], 400);
        }

        // Calculate totals
        $subtotal = 0;
        foreach ($cartItems as $item) {
            if (!$item->menuItem->is_available) {
                return response()->json([
                    'success' => false,
                    'message' => "Item {$item->menuItem->name} is not available"
                ], 400);
            }
            $subtotal += $item->quantity * $item->menuItem->final_price;
        }

        $tax = 0;
        $deliveryFee = 1000;
        $discount = 0;

        // Apply coupon if provided
        if ($request->coupon_code) {
            $coupon = Coupon::where('code', $request->coupon_code)->first();
            if ($coupon && $coupon->isValid()) {
                $discount = $coupon->calculateDiscount($subtotal);
                if ($discount > 0) {
                    $coupon->increment('used_count');
                }
            }
        }

        $total = $subtotal + $tax + $deliveryFee - $discount;

        DB::beginTransaction();
        try {
            // Create order
            $order = Order::create([
                'user_id' => $user->id,
                'order_number' => Order::generateOrderNumber(),
                'status' => 'pending',
                'payment_status' => $request->payment_method === 'online' ? 'paid' : 'pending',
                'payment_method' => $request->payment_method,
                'subtotal' => $subtotal,
                'tax' => $tax,
                'delivery_fee' => $deliveryFee,
                'discount' => $discount,
                'total' => $total,
                'delivery_address' => $request->delivery_address,
                'delivery_phone' => $request->delivery_phone,
                'notes' => $request->notes,
                'estimated_delivery_time' => now()->addMinutes(45),
            ]);

            // Create order items
            foreach ($cartItems as $cartItem) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'menu_item_id' => $cartItem->menu_item_id,
                    'item_name' => $cartItem->menuItem->name,
                    'quantity' => $cartItem->quantity,
                    'price' => $cartItem->menuItem->final_price,
                    'special_instructions' => $cartItem->special_instructions ?? null,
                ]);
            }

            // Clear DB cart if it was used
            Cart::where('user_id', $user->id)->delete();

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Order placed successfully',
                'data' => $order->load('items.menuItem')
            ], 201);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Failed to place order: ' . $e->getMessage()
            ], 500);
        }
    }

    public function cancel(Request $request, $id)
    {
        $order = Order::where('user_id', $request->user()->id)
            ->where('id', $id)
            ->first();

        if (!$order) {
            return response()->json([
                'success' => false,
                'message' => 'Order not found'
            ], 404);
        }

        if (!in_array($order->status, ['pending', 'confirmed'])) {
            return response()->json([
                'success' => false,
                'message' => 'Order cannot be cancelled'
            ], 400);
        }

        $order->update(['status' => 'cancelled']);


        return response()->json([
            'success' => true,
            'message' => 'Order cancelled successfully',
            'data' => $order
        ]);
    }

    // Admin methods
    public function adminIndex(Request $request)
    {
        $query = Order::with(['items.menuItem', 'user']);

        if ($request->has('status')) {
            $query->where('status', $request->status);
        }

        if ($request->has('date')) {
            $query->whereDate('created_at', $request->date);
        }

        $orders = $query->orderBy('created_at', 'desc')->get();

        return response()->json([
            'success' => true,
            'data' => $orders
        ]);
    }

    public function updateStatus(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'status' => 'required|in:pending,confirmed,preparing,ready,out_for_delivery,delivered,cancelled',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $order = Order::find($id);

        if (!$order) {
            return response()->json([
                'success' => false,
                'message' => 'Order not found'
            ], 404);
        }

        $order->update(['status' => $request->status]);

        if ($request->status === 'delivered') {
            $order->update([
                'delivered_at' => now(),
                'payment_status' => 'paid'
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Order status updated',
            'data' => $order
        ]);
    }
}
