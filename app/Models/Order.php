<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'status',
        'customer_id',
        'value'
    ];

    protected $hidden = [
        'deleted_at'
    ];

    public function customer()
    {
        $this->belongsTo(Customer::class);
    }
}
