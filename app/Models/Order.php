<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'status',
        'value',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public function customer()
    {
        $this->belongsTo(Customer::class);
    }
}
