<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;
use NumberFormatter;

class RenenueComparisonResource extends JsonResource
{
    public function toArray($request): array
    {
        $formatter = new NumberFormatter('pt_BR', NumberFormatter::CURRENCY);
        $ordersValuesSum = round($this->resource->sum('value'));
        $ordersGroupedByDate = $this->resource->groupBy(function ($item) {
            return Carbon::parse($item->created_at)->toDateString();
        });
        $sliceOrdersInEight = $ordersGroupedByDate->slice(0, 8);
        $sumOfOrderValuesByDate = $sliceOrdersInEight->map(function ($orders) {
            return round($orders->sum('value'));
        });
        $orderDays = $sumOfOrderValuesByDate->keys()->map(function ($day) {
            return Carbon::parse($day)->day;
        });
        return [
            'series' => [
                [
                    'name' => trans('constants.thisMonth'),
                    'data' => $sumOfOrderValuesByDate->flatten()
                ],
            ],
            'analyticsData' => [
                'thisMonth' => $formatter->formatCurrency($ordersValuesSum, 'BRL'),
            ],
            'categories' => $orderDays,
        ];
    }
}
