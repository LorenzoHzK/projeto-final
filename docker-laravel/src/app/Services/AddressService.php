<?php

namespace App\Services;

use App\Models\Address;
use Illuminate\Http\Request;
use App\Repositories\AddressRepository;

class AddressService
{
    public function __construct(protected AddressRepository $addressRepository, Request $request)
    {
        $this->AddressRepository = $addressRepository;
        $this->request = $request;
    }

    public function createAddress()
    {
        $validatedData = $this->request->validate([
            "street" => "required|string|min:3|max:255",
            "number" => "required|string|min:1|max:255",
            "zipcode" => "required|string|min:8|max:8",
            "city" => "required|string|min:3|max:255",
            "state" => "required|string|min:2|max:2",
            "country" => "required|string|min:2|max:20",
        ]);

        $validatedData['user_id'] = auth()->id();

        $address = $this->AddressRepository->create($validatedData);

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

    public function updateAddress(string $id)
    {
        $address = address::find($id);
        $address->update([
            "street" => $this->request->street,
            "number" => $this->request->number,
            "zipcode" => $this->request->zipcode,
            "city" => $this->request->city,
            "state" => $this->request->state,
            "country" => $this->request->country
        ]);

        return response()->json([
            "message" => "Address updated successfully",
            "address" => $address
        ]);
    }
}
