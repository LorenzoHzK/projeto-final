<?php

namespace App\Http\Controllers;

use App\Services\AddressService;

class AddressController extends Controller
{
    public function __construct(protected AddressService $addressService)
    {
        $this->AddressService = $addressService;
    }

    public function createAddress()
    {
        return $this->AddressService->createAddress();
    }

    public function showAddress($id = null)
    {
        return $this->AddressService->showAddress($id);
    }

    public function deleteAddress(string $id){
        return $this->AddressService->deleteAddress($id);
    }

    public function updateAddress(String $id)
        {
        return $this->AddressService->updateAddress($id);
        }
}
