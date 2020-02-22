<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
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
        'customer_id',
        'updated_at',
        'deleted_at'
    ];

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    public function getValueAttribute()
    {
        return $this->attributes['value'] / 100;
    }

    public function setValueAttribute($value)
    {
        $this->attributes['value'] = $value * 100;
    }
}
