<?php

namespace App\Repositories\Dish;

use App\Http\Requests\Dish\DestroyRequest;
use App\Http\Requests\Dish\IndexRequest;
use App\Http\Requests\Dish\StoreRequest;
use App\Http\Requests\Dish\UpdateRequest;
use App\Http\Resources\Dish\DishCollection;
use App\Http\Resources\Dish\DishResource;
use App\Http\Resources\Dish\PaginatedDishCollection;
use App\Interfaces\DishInterface;
use App\Models\Dish;
use App\Traits\ResponseApiTrait;
use Illuminate\Http\JsonResponse;

class DishRepository implements DishInterface
{
    use ResponseApiTrait;

    public function index(IndexRequest $request): JsonResponse
    {
        $dishes = new Dish();
        if (!empty($request->order_by)) {
            $dishes = $dishes->orderBy($request->order_by);
        }

        if (!empty($request->page && $request->limit)) {
            $dishes = new PaginatedDishCollection($dishes->paginate($request->limit));
        } else {
            $dishes = new DishCollection($dishes->get());
        }

        return $this->successResponse($dishes);
    }

    public function store(StoreRequest $request): JsonResponse
    {
        $dish = Dish::create([
                                 'name' => $request->name,
                                 'price' => $request->price
                             ]);

        return $this->successResponse(new DishResource($dish));
    }

    public function update(UpdateRequest $request): JsonResponse
    {
        $dish = Dish::findOrFail($request->id);

        $dish->update(
            $request->only([
                               'name',
                               'price'
                           ])
        );

        return $this->successResponse(new DishResource($dish));
    }

    public function destroy(DestroyRequest $request): JsonResponse
    {
        $dish = Dish::findOrFail($request->id);
        $dish->delete();
        return $this->successResponse();
    }
}
