<?php

namespace App\Services;

use App\Models\Address;
use Illuminate\Http\Request;
use App\Repositories\AddressRepository;

class AddressService
{
    protected $addressRepository;

    public function __construct(AddressRepository $addressRepository)
    {
        $this->addressRepository = $addressRepository;
    }

    public function createAddress(Request $request)
    {
        $validatedData = $request->validate([
            "street" => "required|string|min:3|max:255",
            "number" => "required|string|min:1|max:255",
            "zipcode" => "required|string|min:8|max:8",
            "city" => "required|string|min:3|max:255",
            "state" => "required|string|min:2|max:2",
            "country" => "required|string|min:2|max:20",
        ]);

        $validatedData['user_id'] = auth()->id();

        $address = $this->addressRepository->create($validatedData);

        return response()->json([
            "message" => "Address created successfully",
            "data" => $address
        ], 201);
    }

    public function showAddress($id = null)
    {
        if ($id) {
            $address = Address::find($id);
            return response()->json(['address' => $address]);
        } else {
            $addresses = Address::all();
            return response()->json(['addresses' => $addresses]);
        }
    }

    public function deleteAddress(string $id)
    {
        $address = address::find($id);
        $address->delete();
        return response()->json([
            'message' => $address,'address deleted successfully',
        ]);
    }

    public function updateAddress(Request $request, string $id)
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
}
