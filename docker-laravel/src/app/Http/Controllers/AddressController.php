<?php

namespace App\Http\Controllers;

use App\Models\address;
use Illuminate\Http\Request;
use App\Services\AddressService;

class AddressController extends Controller
{
    protected $addressService;

    public function __construct(AddressService $addressService)
    {
        $this->addressService = $addressService;
    }

    public function createAddress(Request $request)
    {
        return $this->addressService->createAddress($request);
    }

    public function showAddress($id = null)
    {
        return $this->addressService->showAddress($id);
    }

    public function deleteAddress(string $id){
        return $this->addressService->deleteAddress($id);
    }

    public function updateAddress(Request $request, String $id)
        {
        return $this->addressService->updateAddress($request, $id);
        }
}
