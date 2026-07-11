<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Address;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AddressController extends Controller
{
    public function index()
    {
        $addresses = Address::where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('customer.addresses.index', compact('addresses'));
    }

    public function create()
    {
        return view('customer.addresses.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'full_name'      => 'required|string|max:255',
            'mobile'         => 'required|string|max:20',
            'email'          => 'nullable|email|max:255',
            'address_line1'  => 'required|string',
            'address_line2'  => 'nullable|string',
            'city'           => 'required|string|max:100',
            'state'          => 'required|string|max:100',
            'country'        => 'required|string|max:100',
            'postal_code'    => 'required|string|max:20',
        ]);

        Address::create([
            'user_id'        => Auth::id(),
            'full_name'      => $request->full_name,
            'mobile'         => $request->mobile,
            'email'          => $request->email,
            'address_line1'  => $request->address_line1,
            'address_line2'  => $request->address_line2,
            'city'           => $request->city,
            'state'          => $request->state,
            'country'        => $request->country,
            'postal_code'    => $request->postal_code,
            'is_default'     => Address::where('user_id', Auth::id())->count() == 0,
        ]);

        return redirect()
            ->route('addresses.index')
            ->with('success', 'Address added successfully.');
    }

    public function edit(Address $address)
    {
        abort_if($address->user_id != Auth::id(), 403);

        return view('customer.addresses.edit', compact('address'));
    }

    public function update(Request $request, Address $address)
    {
        abort_if($address->user_id != Auth::id(), 403);

        $request->validate([
            'full_name'      => 'required|string|max:255',
            'mobile'         => 'required|string|max:20',
            'email'          => 'nullable|email|max:255',
            'address_line1'  => 'required|string',
            'address_line2'  => 'nullable|string',
            'city'           => 'required|string|max:100',
            'state'          => 'required|string|max:100',
            'country'        => 'required|string|max:100',
            'postal_code'    => 'required|string|max:20',
        ]);

        $address->update([
            'full_name'      => $request->full_name,
            'mobile'         => $request->mobile,
            'email'          => $request->email,
            'address_line1'  => $request->address_line1,
            'address_line2'  => $request->address_line2,
            'city'           => $request->city,
            'state'          => $request->state,
            'country'        => $request->country,
            'postal_code'    => $request->postal_code,
        ]);

        return redirect()
            ->route('addresses.index')
            ->with('success', 'Address updated successfully.');
    }

    public function destroy(Address $address)
    {
        abort_if($address->user_id != Auth::id(), 403);

        $address->delete();

        return redirect()
            ->route('addresses.index')
            ->with('success', 'Address deleted successfully.');
    }

    public function setDefault(Address $address)
    {
        abort_if($address->user_id != Auth::id(), 403);

        Address::where('user_id', Auth::id())
            ->update([
                'is_default' => false,
            ]);

        $address->update([
            'is_default' => true,
        ]);

        return redirect()
            ->route('addresses.index')
            ->with('success', 'Default address updated successfully.');
    }
}