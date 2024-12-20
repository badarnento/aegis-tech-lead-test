<?php

namespace App\Http\Controllers\Api;

use App\Models\Order;
use App\Http\Requests\OrderRequest;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    /**
     * Create a new order.
     *
     * @param \App\Http\Requests\OrderRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(OrderRequest $request)
    {
        try {

            $order = Order::create([
                'user_id' => $request->user_id
            ]);

            return response()->json(['message' => 'Order created successfully', 'order' => $order], 201);
        } catch (\Exception $e) {
            Log::error('Error creating order: ' . $e->getMessage(), ['trace' => $e->getTrace()]);
            return response()->json(['message' => 'Failed to create order'], 500);
        }
    }
}
