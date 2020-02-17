<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderRequest;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class OrderController extends Controller
{
    public function index(): Response
    {
        return $this->respondWith(Order::with('customer')->paginate(10));
    }

    public function store(OrderRequest $request): Response
    {
        return $this->respondWith(Order::create($request->validated()), Response::HTTP_ACCEPTED);
    }

    public function update(OrderRequest $request): Response
    {
        $customer = OrderRequest::findOrFail($request->id);
        $customer->update($request->validated());
        return $this->respondWith($customer);
    }

    public function show(Request $request): Response
    {
        return $this->respondWith(OrderRequest::findOrFail($request->id));
    }

    public function delete(Request $request): Response
    {
        $customer = OrderRequest::findOrFail($request->id);
        $customer->delete();
        return $this->respondWith('messages.order_delete_success');
    }
}
