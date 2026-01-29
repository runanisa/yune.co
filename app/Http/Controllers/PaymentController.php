<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class PaymentController extends Controller
{
    // Halaman payment
    public function index(Order $order)
    {
        if ($order->status !== 'pending') {
            return redirect()->route('overview');
        }

        $order->load('orderDetails.product');
        return view('payment.index', compact('order'));
    }

    // PROSES BAYAR
    public function pay(Request $request, Order $order)
    {
        $request->validate([
            'paid' => 'required|numeric|min:0'
        ]);

        $order->load('orderDetails.product');

        // hitung total
        $total = $order->orderDetails->sum(function ($item) {
            return $item->quantity * $item->product->price;
        });

        if ($request->paid < $total) {
            return back()->with('error', 'Uang bayar kurang');
        }

        $change = $request->paid - $total;

        // ✅ SIMPAN ORDER
        $order->update([
            'total'  => $total,
            'paid'   => $request->paid,
            'change' => $change,
            'status' => 'paid',
        ]);

        // ✅ KURANGI STOK
        foreach ($order->orderDetails as $item) {
            $product = $item->product;
            $product->stock -= $item->quantity;
            $product->save();
        }

        // ✅ CETAK STRUK
        if ($request->print == 1) {
            return redirect()->route('payment.receipt', $order->id);
        }

        return redirect()->route('overview')
            ->with('success', 'Pembayaran berhasil');
    }

    // CETAK STRUK (PDF)
    public function receipt(Order $order)
    {
        $order->load('orderDetails.product');

        $pdf = Pdf::loadView('payment.receipt', compact('order'));

        // ⬇️ download PDF
        return $pdf->download('struk-'.$order->id.'.pdf');
    }
}
