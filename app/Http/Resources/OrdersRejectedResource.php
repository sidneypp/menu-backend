<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class OrdersRejectedResource extends JsonResource
{
    public function toArray($request): array
    {
        $ordersCount = $this->resource->count();
        $ordersGroupedByDate = $this->resource->groupBy(function ($item) {
            return Carbon::parse($item->created_at)->toDateString();
        });
        $sliceOrdersInFive = $ordersGroupedByDate->slice(0, 5);
        return [
            'series' => [
                [
                    'name' => trans('constants.orders'),
                    'data' => $sliceOrdersInFive->map(function ($item) {
                        return $item->count();
                    })->flatten()
                ]
            ],
            'analyticsData' => [
                'orders' => $ordersCount
            ]
        ];
    }
}
