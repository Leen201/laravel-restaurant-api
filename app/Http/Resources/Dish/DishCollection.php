<?php

namespace App\Http\Resources\Dish;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;
use JsonSerializable;

class DishCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  Request  $request
     * @return array|Arrayable|JsonSerializable
     */
    public function toArray($request): array|JsonSerializable|Arrayable
    {
        $data = $this->collection->map(function ($dish){
            return[
                'id' => $dish->id,
                'name' => $dish->name,
                'price' => $dish->price
            ];
        });
        return ['data' => $data];
    }
}
