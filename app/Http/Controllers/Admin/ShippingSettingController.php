<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ShippingSetting;
use Illuminate\Http\Request;

class ShippingSettingController extends Controller
{
    public function index()
    {
        $shipping = ShippingSetting::first();

        if (!$shipping) {
            $shipping = ShippingSetting::create([
                'shipping_type' => 'flat',
                'shipping_charge' => 80,
                'free_shipping_above' => 999,
                'cod_charge' => 40,
                'status' => true,
            ]);
        }

        return view('admin.shipping.index', compact('shipping'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'shipping_type' => 'required',
            'shipping_charge' => 'required|numeric|min:0',
            'free_shipping_above' => 'required|numeric|min:0',
            'cod_charge' => 'required|numeric|min:0',
        ]);

        $shipping = ShippingSetting::first();

        $shipping->update([
            'shipping_type' => $request->shipping_type,
            'shipping_charge' => $request->shipping_charge,
            'free_shipping_above' => $request->free_shipping_above,
            'cod_charge' => $request->cod_charge,
            'status' => $request->has('status'),
        ]);

        return back()->with('success', 'Shipping settings updated successfully.');
    }
}