<?php

namespace App\Http\Controllers;

use App\Enumerators\OrderStatus;
use App\Http\Resources\CustomersGainedResource;
use App\Http\Resources\OrdersDeliveredResource;
use App\Http\Resources\OrdersReceivedResource;
use App\Http\Resources\OrdersRejectedResource;
use App\Http\Resources\RenenueComparisonResource;
use App\Http\Resources\RevenueGeneratedResource;
use App\Models\Customer;
use App\Models\Order;
use Carbon\Carbon;

class StatisticsController extends Controller
{
    public function customersGained()
    {
        $customersOrderedByDate = Customer::query()
            ->orderBy('created_at', 'desc')->get();
        return new CustomersGainedResource($customersOrderedByDate);
    }

    public function revenueGenerated()
    {
        $ordersOrderedByDate = Order::query()
            ->orderBy('created_at', 'desc')->get();
        return new RevenueGeneratedResource($ordersOrderedByDate);
    }

    public function ordersRejected()
    {
        $ordersWhereStatusIsEqualToRejected = Order::query()
            ->where('status', OrderStatus::REJECTED);
        $ordersOrderedByDate = $ordersWhereStatusIsEqualToRejected
            ->orderBy('created_at', 'desc')->get();
        return new OrdersRejectedResource($ordersOrderedByDate);
    }

    public function ordersReceived()
    {
        $ordersOrderedByDate = Order::query()
            ->orderBy('created_at', 'desc')->get();
        return new OrdersReceivedResource($ordersOrderedByDate);
    }

    public function revenueComparison()
    {
        $ordersThisMonth = Order::query()
            ->orderBy('created_at', 'desc')
            ->whereMonth('created_at', Carbon::now()->month)->get();
        return new RenenueComparisonResource($ordersThisMonth);
    }

    public function ordersDelivered()
    {
        return new OrdersDeliveredResource(Order::all());
    }
}
