<?php

namespace App\Http\Controllers;

use App\Http\Requests\CustomerRequest;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CustomerController extends Controller
{
    public function index(): Response
    {
        return $this->respondWith(Customer::paginate(10));
    }

    public function store(CustomerRequest $request): Response
    {
        return $this->respondWith(Customer::create($request->validated()), Response::HTTP_ACCEPTED);
    }

    public function update(CustomerRequest $request): Response
    {
        $customer = Customer::findOrFail($request->id);
        $customer->update($request->validated());
        return $this->respondWith($customer);
    }

    public function show(Request $request): Response
    {
        return $this->respondWith(Customer::findOrFail($request->id));
    }

    public function delete(Request $request): Response
    {
        $customer = Customer::findOrFail($request->id);
        $customer->delete();
        return $this->respondWith('messages.customer_delete_success');
    }
}
