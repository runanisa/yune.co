<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Order;
use App\Models\OrderDetail;

class CartController extends Controller
{
    public function add(Product $product)
    {
        if ($product->stock < 1) {
            return back()->with('stock_error', 'Stok produk habis');
        }

        $order = Order::firstOrCreate(['status' => 'pending']);

        $item = OrderDetail::where('order_id', $order->id)
            ->where('product_id', $product->id)
            ->first();

        $currentQty = $item ? $item->quantity : 0;

        if ($currentQty >= $product->stock) {
            return back()->with(
                'stock_error',
                'Stok hanya tersedia ' . $product->stock
            );
        }

        if ($item) {
            $item->increment('quantity');
        } else {
            OrderDetail::create([
                'order_id' => $order->id,
                'product_id' => $product->id,
                'quantity' => 1
            ]);
        }

        return back()->with('success', 'Produk ditambahkan ke keranjang');
    }

    public function remove($id)
    {
        $item = OrderDetail::find($id);
        if ($item) {
            $item->delete();
        }

        return back();
    }
}