<?php

namespace App\Http\Controllers;

use App\Services\AddressService;

class AddressController extends Controller
{
    public function __construct(protected AddressService $addressService)
    {}

    public function createAddress()
    {
        return $this->addressService->createAddress();
    }

    public function showAddress($id = null)
    {
        return $this->addressService->showAddress($id);
    }

    public function deleteAddress(string $id){
        return $this->addressService->deleteAddress($id);
    }

    public function updateAddress(String $id)
        {
        return $this->addressService->updateAddress($id);
        }
}
