<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderStatusController extends Controller
{
    public function update(Request $request, Order $order)
    {
        $request->validate([
            'order_status' => [
                'required',
                'in:Pending,Confirmed,Packed,Shipped,Out For Delivery,Delivered,Cancelled,Returned'
            ],
        ]);

        $order->order_status = $request->order_status;

        if (
            $request->order_status === 'Delivered'
            && empty($order->delivered_at)
        ) {
            $order->delivered_at = now();
        }

        $order->save();

        return back()->with(
            'success',
            'Order status updated successfully.'
        );
    }
}