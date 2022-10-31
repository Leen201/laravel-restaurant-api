<?php

namespace App\Http\Controllers\Dish;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dish\DestroyRequest;
use App\Http\Requests\Dish\IndexRequest;
use App\Http\Requests\Dish\StoreRequest;
use App\Http\Requests\Dish\UpdateRequest;
use App\Interfaces\DishInterface;
use Illuminate\Http\JsonResponse;

class DishController extends Controller
{
    protected DishInterface $interface;

    public function __construct(DishInterface $interface)
    {
        $this->interface = $interface;
    }

    public function index(IndexRequest $request): JsonResponse
    {
        return $this->interface->index($request);
    }

    public function store(StoreRequest $request): JsonResponse
    {
        return $this->interface->store($request);
    }

    public function update(UpdateRequest $request): JsonResponse
    {
        return $this->interface->update($request);
    }

    public function destroy(DestroyRequest $request): JsonResponse
    {
        return $this->interface->destroy($request);
    }


}
