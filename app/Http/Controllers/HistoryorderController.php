<?php

namespace App\Http\Controllers;

use App\Models\Order;

class HistoryOrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('orderDetails.product')
            ->where('status', 'paid')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('history.index', compact('orders'));
    }
}
