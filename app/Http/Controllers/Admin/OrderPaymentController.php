<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderPaymentController extends Controller
{
    public function update(Request $request, Order $order)
    {
        $request->validate([
            'payment_status' => [
                'required',
                'in:Pending,Paid,Failed,Refunded',
            ],
        ]);

        $order->update([
            'payment_status' => $request->payment_status,
        ]);

        return back()->with(
            'success',
            'Payment status updated successfully.'
        );
    }
}