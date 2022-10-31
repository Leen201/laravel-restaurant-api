<?php

namespace App\Http\Controllers\Order;

use App\Http\Controllers\Controller;
use App\Http\Requests\Order\DestroyRequest;
use App\Http\Requests\Order\IndexRequest;
use App\Http\Requests\Order\ShowRequest;
use App\Http\Requests\Order\StoreOrUpdateRequest;
use App\Interfaces\OrderInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    protected OrderInterface $interface;

    public function __construct(OrderInterface $interface)
    {
        $this->interface = $interface;
    }

    public function index(IndexRequest $request): JsonResponse
    {
        return $this->interface->index($request);
    }

    public function show(ShowRequest $request): JsonResponse
    {
        return $this->interface->show($request);
    }

    public function storeOrUpdate(StoreOrUpdateRequest $request): JsonResponse
    {
        return $this->interface->storeOrUpdate($request);
    }

    public function destroy(DestroyRequest $request): JsonResponse
    {
        return $this->interface->destroy($request);
    }
}
