<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResouce extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'status' => $this->status,
            'value' => $this->value,
            'created_at' => Carbon::parse($this->created_at)->format('Y-m-d H:i:s'),
            'customer' => $this->customer
        ];
    }
}
