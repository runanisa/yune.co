<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Http\Request;

class OverviewController extends Controller
{
    // ===============================
    // HALAMAN OVERVIEW / KASIR
    // ===============================
    public function index(Request $request)
    {
        $categoryId = $request->query('category');

        $categories = Category::all();

        $products = Product::with('category')
            ->when($categoryId, function ($q) use ($categoryId) {
                $q->where('category_id', $categoryId);
            })
            ->where('stock', '>', 0)
            ->get();

        $order = Order::with('orderDetails.product')
            ->where('status', 'pending')
            ->first();

        return view('overview.index', compact(
            'categories',
            'products',
            'categoryId',
            'order'
        ));
    }

    // ===============================
    // TAMBAH KE KERANJANG
    // ===============================
    public function addToCart($productId)
    {
        $product = Product::findOrFail($productId);

        $order = Order::firstOrCreate([
            'status' => 'pending'
        ]);

        $item = OrderDetail::where('order_id', $order->id)
            ->where('product_id', $productId)
            ->first();

        $currentQty = $item ? $item->quantity : 0;

        // ❌ CEK STOK
        if ($currentQty >= $product->stock) {
            return back()->with('stock_error', 
                'Stok hanya tersedia ' . $product->stock
            );
        }

        if ($item) {
            $item->increment('quantity');
        } else {
            OrderDetail::create([
                'order_id'   => $order->id,
                'product_id' => $productId,
                'quantity'   => 1
            ]);
        }

        return back();
    }
}
