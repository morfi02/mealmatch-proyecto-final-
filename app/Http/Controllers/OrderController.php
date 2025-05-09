<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'cocinero_id' => 'required|exists:users,id',
            'items' => 'required|array',
        ]);

        $order = Order::updateOrCreate(
            [
                'user_id' => auth()->id(),
                'cocinero_id' => $request->cocinero_id,
            ],
            [
                'items' => $request->items,
            ]
        );

        return response()->json(['message' => 'Pedido realizado con éxito', 'order' => $order]);
    }
}
