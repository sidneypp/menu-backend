<?php

use App\Models\Customer;
use App\Models\Order;
use Illuminate\Database\Seeder;

class CustomerTableSeeder extends Seeder
{
    public function run(): void
    {
        factory(Customer::class, 1000)->create()->each(function (Customer $customer): void {
            $customer->orders()->save(factory(Order::class)->make());
        });
    }
}
