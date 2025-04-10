<?php

namespace App\Http\Controllers;

use App\Models\address;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    public function index()
    {
        $address = address::all();
        return response()->json($address);
    }

    public function store(Request $request)
    {
        $address = Address ::create([
            "street" => $request->street,
            "number" => $request->number,
            "zipcode" => $request->zipcode,
            "city" => $request->city,
            "state" => $request->state,
            "country" => $request->country
        ]);

        return response()->json([
            "message" => "Address created successfully",
            "address" => $address
        ]);
    }

    public function show(string $id)
    {
        $address = address::find($id);
        return response()->json($address);
    }

    public function update(Request $request, string $id)
    {
        $address = address::find($id);
        $address->update([
            "street" => $request->street,
            "number" => $request->number,
            "zipcode" => $request->zipcode,
            "city" => $request->city,
            "state" => $request->state,
            "country" => $request->country
        ]);

        return response()->json([
            "message" => "Address updated successfully",
            "address" => $address
        ]);
    }

    public function destroy(string $id)
    {
        //
    }
}
