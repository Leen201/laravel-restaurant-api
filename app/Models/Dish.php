<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Dish extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'dishes';

    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'price' => 'float:6,2',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function orders(): BelongsToMany
    {
        return $this->belongsToMany(
            Order::class,
            'dishes_orders',
            'dish_id',
            'order_id')->withPivot('amount')->withTimestamps();
    }
}
