<?php

namespace App\Http\Resources\Dish;

use App\Traits\PaginatedCollectionTrait;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Resources\Json\ResourceCollection;
use JsonSerializable;

class PaginatedDishCollection extends ResourceCollection
{
    use PaginatedCollectionTrait;

    public function toArray($request): array|JsonSerializable|Arrayable
    {
        $data = $this->collection->map(function ($dish){
            return[
                'id' => $dish->id,
                'name' => $dish->name,
                'price' => $dish->price
            ];
        });
        return [
            'data' => $data,
            'pagination' => $this->pagination];
    }
}
