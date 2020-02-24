<?php

namespace App\Http\Resources;

use App\Enumerators\OrderStatus;
use Illuminate\Http\Resources\Json\JsonResource;

class OrdersDeliveredResource extends JsonResource
{
    public function toArray($request): array
    {
        $ordersGroupedByStatus = $this->resource->groupBy('status');
        $totalOrdersDelivered = $ordersGroupedByStatus[OrderStatus::DELIVERED]->count();
        $totalOrdersPending = $ordersGroupedByStatus[OrderStatus::PENDING]->count();

        $totalOrdersDeliveredAndPending = $totalOrdersDelivered + $totalOrdersPending;
        $checksIfTheTotalIsZero = $totalOrdersDeliveredAndPending === 0 ? 1 : $totalOrdersDeliveredAndPending;

        $percentageSalesDelivered = round(($totalOrdersDelivered / $checksIfTheTotalIsZero) * 100);
        return [
            'series' => [$percentageSalesDelivered],
            'analyticsData' => [
                'delivered' => $ordersGroupedByStatus[OrderStatus::DELIVERED]->count(),
                'pending' => $ordersGroupedByStatus[OrderStatus::PENDING]->count()
            ]
        ];
    }
}
