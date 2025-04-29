<?php

namespace App\Services;

use App\Models\Address;
use Illuminate\Http\Request;
use App\Repositories\AddressRepository;

class AddressService
{
    public function __construct(
        protected AddressRepository $addressRepository,
        protected Request $request
    ){
        $this->AddressRepository = $addressRepository;
        $this->Request = $request;
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
        $userId = auth()->user()->id;

        if ($id = request()->get('id')) {
            $address = Address::where('id', $id)->where('user_id', $userId)->first();

            if (!$address) {
                return response()->json(['message' => 'Addres not Found'], 404);
            }

            return response()->json(['address' => $address]);
        }
        else {
            $addresses = Address::where('user_id', $userId)->get();

            return response()->json(['addresses' => $addresses]);
        }
    }

    public function deleteAddress(string $id)
    {
        $userId = auth()->user()->id;
        $address = Address::where('id', $id)->where('user_id', $userId)->first();

        if (!$address) {
            return response()->json(['message' => 'Address not founded'], 404);
        }

        $this->AddressRepository->delete($id);

        return response()->json([
            'message' => 'address delete with successful'
        ]);
    }

    public function updateAddress(string $id)
    {
        $userId = auth()->user()->id;

        $address = $this->AddressRepository->find($id);
        if (!$address || $address->user_id != $userId) {
            return response()->json(['message' => 'Address not found'], 403);
        }

        $validatedData = $this->request->validate([
            "street" => "required|string|min:3|max:255",
            "number" => "sometimes|string|min:1|max:255",
            "zipcode" => "sometimes|string|min:8|max:8",
            "city" => "sometimes|string|min:3|max:255",
            "state" => "sometimes|string|min:2|max:2",
            "country" => "sometimes|string|min:2|max:20",
        ]);

        $address = $this->AddressRepository->update($validatedData, $id);

        return response()->json([
            "message" => "Address updated successfully",
            "address" => $address
        ]);
    }
}
