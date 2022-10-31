<?php

namespace App\Interfaces;

use App\Http\Requests\Dish\DestroyRequest;
use App\Http\Requests\Dish\IndexRequest;
use App\Http\Requests\Dish\StoreRequest;
use App\Http\Requests\Dish\UpdateRequest;
use Illuminate\Http\JsonResponse;

interface DishInterface
{
    public function index(IndexRequest $request): JsonResponse;

    public function store(StoreRequest $request): JsonResponse;

    public function update(UpdateRequest $request): JsonResponse;

    public function destroy(DestroyRequest $request): JsonResponse;
}
