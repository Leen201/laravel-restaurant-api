<?php

namespace App\Http\Resources\Order;

use DB;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;
use JsonSerializable;

class OrderCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  Request  $request
     * @return array|Arrayable|JsonSerializable
     */
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
        return ['data' => $data];
    }
}
