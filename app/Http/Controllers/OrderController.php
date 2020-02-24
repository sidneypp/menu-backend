<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderRequest;
use App\Http\Resources\OrderResouce;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class OrderController extends Controller
{
    public function index(): Response
    {
        return $this->respondWith(Order::with('customer')->get());
    }

    public function store(OrderRequest $request): Response
    {
        $order = Order::create($request->validated());
        return $this->respondWith(new OrderResouce($order), Response::HTTP_ACCEPTED);
    }

    public function update(OrderRequest $request): Response
    {
        $order = Order::findOrFail($request->id);
        $order->update($request->validated());
        return $this->respondWith(new OrderResouce($order));
    }

    public function show(Request $request): Response
    {
        return $this->respondWith(Order::findOrFail($request->id));
    }

    public function delete(Request $request): Response
    {
        $order = Order::findOrFail($request->id);
        $order->delete();
        return $this->respondWith('messages.order_delete_success');
    }
}
