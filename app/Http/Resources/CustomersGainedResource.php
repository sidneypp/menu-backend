<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class CustomersGainedResource extends JsonResource
{
    public function toArray($request): array
    {
        $customersCount = $this->resource->count();
        $customersGroupedByDate = $this->resource->groupBy(function ($item) {
            return Carbon::parse($item->created_at)->toDateString();
        });
        $sliceCustomersInFive = $customersGroupedByDate->slice(0, 5);
        return [
            'series' => [
                [
                    'name' => trans('constants.customers'),
                    'data' => $sliceCustomersInFive->map(function ($customers) {
                        return $customers->count();
                    })->flatten()
                ]
            ],
            'customers' => $customersCount
        ];
    }
}
