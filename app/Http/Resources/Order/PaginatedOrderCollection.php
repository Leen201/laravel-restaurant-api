<?php

namespace App\Http\Resources\Order;

use App\Traits\PaginatedCollectionTrait;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Resources\Json\ResourceCollection;
use JsonSerializable;

class PaginatedOrderCollection extends ResourceCollection
{
    use PaginatedCollectionTrait;

    public function toArray($request): array|JsonSerializable|Arrayable
    {
        $data = $this->collection->map(function ($order){
            $total = 0;
            foreach ($order->dishes as $dish){
                $total+= $dish->price * $dish->pivot->amount;
            }
            return [
                'id' => $order->id,
                'status' => $order->status,
                'updated_at' => $order->updated_at,
                'total' => $total
            ];
        });
        return
            ['data' => $data,
            'pagination' => $this->pagination,];
    }
}
