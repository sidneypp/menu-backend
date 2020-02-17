<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'first_name',
        'last_name',
        'email'
    ];

    protected $hidden = [
        'deleted_at'
    ];

    public function delete()
    {
        $this->orders()->delete();
        return parent::delete();
    }

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }
}
