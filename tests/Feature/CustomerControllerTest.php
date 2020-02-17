<?php

namespace Tests\Feature;

use App\Models\Customer;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;
use Tests\TestCase;

class CustomerControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testIndexShouldReturnStatus200(): void
    {
        $response = $this->get('/customers');
        $response->assertStatus(Response::HTTP_OK);
    }

    public function testStoreWithValidDataShouldReturnStatus202()
    {
        $customer = factory(Customer::class)->make();
        $response = $this->post('/customers', $customer->toArray());
        $response->assertStatus(Response::HTTP_ACCEPTED);
    }

    public function testUpdateWithValidDataShouldReturnStatus200()
    {
        $customer   = factory(Customer::class)->create();
        $customerId = $customer->id;
        $response   = $this->put("/customers/$customerId");
        $response->assertStatus(Response::HTTP_OK);
    }

    public function testShowWithValidDataShouldReturnStatus200()
    {
        $customer   = factory(Customer::class)->create();
        $customerId = $customer->id;
        $response   = $this->get("/customers/$customerId");
        $response->assertStatus(Response::HTTP_OK);
    }

    public function testDeleteWithValidDataShouldReturnStatus200()
    {
        $customer   = factory(Customer::class)->create();
        $customerId = $customer->id;
        $response   = $this->delete("/customers/$customerId");
        $response->assertStatus(Response::HTTP_OK);
    }
}
