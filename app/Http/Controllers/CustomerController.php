<?php

namespace App\Http\Controllers;

use App\Http\Requests\CustomerRequest;
use App\Models\Customer;
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
        $customer = Customer::find($request->id);
        $customer->update($request->validated());
        return $this->respondWith($customer);
    }

    public function show(CustomerRequest $request): Response
    {
        return $this->respondWith(Customer::find($request->id));
    }

    public function delete(CustomerRequest $request): Response
    {
        Customer::destroy($request->id);
        return $this->respondWith('messages.customer_delete_success');
    }
}
