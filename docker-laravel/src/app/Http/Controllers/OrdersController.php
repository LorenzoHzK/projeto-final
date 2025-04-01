<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Orders;

class OrdersController extends Controller
{
    public function index()
    {
        $orders = Orders::all();
        return response()->json($orders);
    }

    public function store(Request $request)
    {
        $orders = Orders::create([
            "user_id" => $request->user_id,
            "address_id" => $request->address_id,
            "orderDate" => $request->orderDate,
            "cupon_id" => $request->cupon_id,
            "status" => $request->status,
            "totalAmount" => $request->totalAmount
        ]);

        return response()->json([
            "message" => "Order created successfully",
            "orders" => $orders
        ]);
    }

    public function show(string $id)
    {
        $orders = Orders::findOrFail($id);
        return response()->json($orders);
    }

    public function update(Request $request, string $id)
    {
        $orders = Orders::findOrFail($id);
        $orders->update([
            "user_id" => $request->user_id,
            "address_id" => $request->address_id,
            "orderDate" => $request->orderDate,
            "cupon_id" => $request->cupon_id,
            "status" => $request->status,
            "totalAmount" => $request->totalAmount
        ]);

        return response()->json([
            "message" => "Order updated successfully",
            "orders" => $orders
        ]);
    }

    public function destroy(string $id)
    {
        $orders = Orders::findOrFail($id);
        $orders->delete()-onDelete('cascade');

        return response()->json([
            "message" => "Order deleted successfully"
        ]);
    }
}
