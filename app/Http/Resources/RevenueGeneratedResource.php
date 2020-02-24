<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;
use NumberFormatter;

class RevenueGeneratedResource extends JsonResource
{
    public function toArray($request): array
    {
        $formatter = new NumberFormatter('pt_BR',  NumberFormatter::CURRENCY);
        $ordersValuesSum = round($this->resource->sum('value'));
        $ordersGroupedByDate = $this->resource->groupBy(function ($item) {
            return Carbon::parse($item->created_at)->toDateString();
        });
        $sliceOrdersInFive = $ordersGroupedByDate->slice(0, 5);
        return [
            'series' => [
                [
                    'name' => trans('constants.revenue'),
                    'data' => $sliceOrdersInFive->map(function ($orders) {
                        return round($orders->sum('value'));
                    })->flatten()
                ]
            ],
            'revenues' => $formatter->formatCurrency($ordersValuesSum, 'BRL')
        ];
    }
}
