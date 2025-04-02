<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OrderItemController extends Controller
{
    public function index()
    {
        $orderItem = OrderItem::all();
        return response()->json($orderItem);
    }

    public function store(Request $request)
    {
        $orderItem = OrderItem::create([
            "order_id" => $request->order_id,
            "product_id" => $request->product_id,
            "quantity" => $request->quantity
        ]);
    }

    public function show(string $id)
    {
        $orderItem = OrderItem::findOrFail($id);
        return response()->json($orderItem);
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        //
    }
}
