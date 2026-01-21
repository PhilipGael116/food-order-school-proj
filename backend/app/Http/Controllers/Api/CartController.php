<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\MenuItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CartController extends Controller
{
    public function index(Request $request)
    {
        $cartItems = Cart::where('user_id', $request->user()->id)
            ->with('menuItem.category')
            ->get();

        $subtotal = $cartItems->sum(function($item) {
            return $item->quantity * $item->menuItem->final_price;
        });

        return response()->json([
            'success' => true,
            'data' => [
                'items' => $cartItems,
                'subtotal' => $subtotal,
                'item_count' => $cartItems->sum('quantity')
            ]
        ]);
    }

    public function add(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'menu_item_id' => 'required|exists:menu_items,id',
            'quantity' => 'required|integer|min:1',
            'special_instructions' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $menuItem = MenuItem::find($request->menu_item_id);

        if (!$menuItem->is_available) {
            return response()->json([
                'success' => false,
                'message' => 'This item is not available'
            ], 400);
        }

        $cart = Cart::updateOrCreate(
            [
                'user_id' => $request->user()->id,
                'menu_item_id' => $request->menu_item_id,
            ],
            [
                'quantity' => $request->quantity,
                'special_instructions' => $request->special_instructions,
            ]
        );

        return response()->json([
            'success' => true,
            'message' => 'Item added to cart',
            'data' => $cart->load('menuItem')
        ]);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'quantity' => 'required|integer|min:1',
            'special_instructions' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $cart = Cart::where('user_id', $request->user()->id)
            ->where('id', $id)
            ->first();

        if (!$cart) {
            return response()->json([
                'success' => false,
                'message' => 'Cart item not found'
            ], 404);
        }

        $cart->update([
            'quantity' => $request->quantity,
            'special_instructions' => $request->special_instructions,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Cart updated',
            'data' => $cart->load('menuItem')
        ]);
    }

    public function remove(Request $request, $id)
    {
        $cart = Cart::where('user_id', $request->user()->id)
            ->where('id', $id)
            ->first();

        if (!$cart) {
            return response()->json([
                'success' => false,
                'message' => 'Cart item not found'
            ], 404);
        }

        $cart->delete();

        return response()->json([
            'success' => true,
            'message' => 'Item removed from cart'
        ]);
    }

    public function clear(Request $request)
    {
        Cart::where('user_id', $request->user()->id)->delete();

        return response()->json([
            'success' => true,
            'message' => 'Cart cleared'
        ]);
    }
}
