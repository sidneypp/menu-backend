<?php

namespace Tests\Feature;

use App\Models\Customer;
use App\Models\Order;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;
use Tests\TestCase;

class OrderControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testIndexShouldReturnStatus200(): void
    {
        $response = $this->get('/orders');
        $response->assertStatus(Response::HTTP_OK);
    }

    public function testStoreWithValidDataShouldReturnStatus202()
    {
        $customer = factory(Customer::class)->create();
        $order    = factory(Order::class)->make([
            'customer_id' => $customer->id
        ])->makeVisible('customer_id');

        $response = $this->post('/orders', $order->toArray());
        $response->assertStatus(Response::HTTP_ACCEPTED);
    }

    public function testUpdateWithValidDataShouldReturnStatus200()
    {
        $customer = factory(Customer::class)->create();
        $order      = factory(Order::class)->create([
            'customer_id' => $customer->id
        ]);
        $orderId    = $order->id;
        $response   = $this->put("/orders/$orderId");
        $response->assertStatus(Response::HTTP_OK);
    }

    public function testShowWithValidDataShouldReturnStatus200()
    {
        $customer = factory(Customer::class)->create();
        $order      = factory(Order::class)->create([
            'customer_id' => $customer->id
        ])->makeVisible('customer_id');
        $orderId = $order->id;
        $response = $this->get("/orders/$orderId");
        $response->assertStatus(Response::HTTP_OK);
    }

    public function testDeleteWithValidDataShouldReturnStatus200()
    {
        $customer = factory(Customer::class)->create();
        $order      = factory(Order::class)->create([
            'customer_id' => $customer->id
        ]);
        $orderId = $order->id;
        $response = $this->delete("/orders/$orderId");
        $response->assertStatus(Response::HTTP_OK);
    }
}
