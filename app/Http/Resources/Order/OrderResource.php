<?php

namespace App\Http\Resources\Order;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use JsonSerializable;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array|Arrayable|JsonSerializable
     */
    public function toArray($request): array|JsonSerializable|Arrayable
    {
        $total = 0;
        foreach ($this->dishes as $dish){
            $total+= $dish->price * $dish->pivot->amount;
        }
        return [
            'id' => $this->id,
            'status' => $this->status,
            'updated_at' => $this->updated_at,
            'dishes' => $this->dishes->map(function ($dish) {
                return[
                    'id' => $dish->id,
                    'name' => $dish->name,
                    'price' => $dish->price,
                    'amount' => $dish->pivot->amount
                ];
            }),
            'total' => $total
        ];
    }
}
