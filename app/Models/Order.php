<?php

namespace App\Models;

use App\Enums\Order\StatusEnum;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use SoftDeletes;

    protected $table = 'orders';

    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    protected $casts = [
        'id' => 'integer',
        'status' => StatusEnum::class,
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime'
    ];

    public function dishes(): BelongsToMany
    {
        return $this->belongsToMany(
            Dish::class,
            'dishes_orders',
            'order_id',
            'dish_id')->withPivot('amount')->withTimestamps();
    }
}
