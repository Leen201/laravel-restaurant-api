<?php

namespace App\Http\Resources\Dish;

use App\Traits\PaginatedCollectionTrait;
use Illuminate\Http\Resources\Json\ResourceCollection;

class PaginatedDishCollection extends ResourceCollection
{
    use PaginatedCollectionTrait;
}
