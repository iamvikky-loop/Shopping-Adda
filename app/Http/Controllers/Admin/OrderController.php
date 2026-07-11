<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display Orders Listing
     */
    public function index(Request $request)
    {
        $query = Order::with([
            'user',
            'address',
            'items'
        ]);

        // Search
        if ($request->filled('search')) {

            $search = $request->search;

            $query->where(function ($q) use ($search) {

                $q->where('order_number', 'LIKE', "%{$search}%")

                    ->orWhere('invoice_number', 'LIKE', "%{$search}%")

                    ->orWhereHas('user', function ($user) use ($search) {

                        $user->where('name', 'LIKE', "%{$search}%")
                             ->orWhere('email', 'LIKE', "%{$search}%");

                    });

            });

        }

        // Order Status Filter
        if ($request->filled('status')) {

            $query->where('order_status', $request->status);

        }

        // Payment Status Filter
        if ($request->filled('payment')) {

            $query->where('payment_status', $request->payment);

        }

        // Latest Orders
        $orders = $query
                    ->latest()
                    ->paginate(20)
                    ->withQueryString();

        return view(
            'admin.orders.index',
            compact('orders')
        );
    }

    /**
     * Show Order
     */
    public function show(Order $order)
    {
        $order->load([
            'user',
            'address',
            'items.product',
            'items.variant',
            'payment'
        ]);

        return view(
            'admin.orders.show',
            compact('order')
        );
    }
        /**
     * Update Order Status
     */
    public function updateStatus(Request $request, Order $order)
    {
        $request->validate([
            'order_status' => 'required|string',
        ]);

        $order->update([
            'order_status' => $request->order_status,
        ]);

        // Auto set delivered date
        if (
            $request->order_status === 'Delivered'
            && is_null($order->delivered_at)
        ) {
            $order->update([
                'delivered_at' => now(),
            ]);
        }

        return back()->with(
            'success',
            'Order status updated successfully.'
        );
    }

    /**
     * Update Payment Status
     */
    public function updatePaymentStatus(Request $request, Order $order)
    {
        $request->validate([
            'payment_status' => 'required|string',
        ]);

        $order->update([
            'payment_status' => $request->payment_status,
        ]);

        return back()->with(
            'success',
            'Payment status updated successfully.'
        );
    }

    /**
     * Update Tracking Information
     */
    public function updateTracking(Request $request, Order $order)
    {
        $request->validate([
            'courier' => 'nullable|string|max:255',
            'tracking_number' => 'nullable|string|max:255',
            'expected_delivery' => 'nullable|date',
        ]);

        $order->update([
            'courier' => $request->courier,
            'tracking_number' => $request->tracking_number,
            'expected_delivery' => $request->expected_delivery,
        ]);

        return back()->with(
            'success',
            'Tracking information updated successfully.'
        );
    }

    /**
     * Update Admin Note
     */
    public function updateAdminNote(Request $request, Order $order)
    {
        $request->validate([
            'admin_note' => 'nullable|string',
        ]);

        $order->update([
            'admin_note' => $request->admin_note,
        ]);

        return back()->with(
            'success',
            'Admin note saved successfully.'
        );
    }
        /**
     * Delete Order
     */
    public function destroy(Order $order)
    {
        $order->delete();

        return redirect()
            ->route('admin.orders.index')
            ->with(
                'success',
                'Order deleted successfully.'
            );
    }
}