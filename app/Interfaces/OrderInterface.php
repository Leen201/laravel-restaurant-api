<?php

namespace App\Interfaces;


use App\Http\Requests\Order\DestroyRequest;
use App\Http\Requests\Order\IndexRequest;
use App\Http\Requests\Order\ShowRequest;
use App\Http\Requests\Order\StoreOrUpdateRequest;
use Illuminate\Http\JsonResponse;

interface OrderInterface
{
    public function index(IndexRequest $request): JsonResponse;

    public function show(ShowRequest $request): JsonResponse;

    public function storeOrUpdate(StoreOrUpdateRequest $request): JsonResponse;

    public function destroy(DestroyRequest $request): JsonResponse;
}
