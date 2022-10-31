<?php

namespace App\Repositories\Order;

use App\Enums\Order\StatusEnum;
use App\Http\Requests\Order\DestroyRequest;
use App\Http\Requests\Order\IndexRequest;
use App\Http\Requests\Order\ShowRequest;
use App\Http\Requests\Order\StoreOrUpdateRequest;
use App\Http\Resources\Order\OrderCollection;
use App\Http\Resources\Order\OrderResource;
use App\Http\Resources\Order\PaginatedOrderCollection;
use App\Interfaces\OrderInterface;
use App\Models\Order;
use App\Traits\ResponseApiTrait;
use Illuminate\Http\JsonResponse;

class OrderRepository implements OrderInterface
{
    use ResponseApiTrait;

    public function index(IndexRequest $request): JsonResponse
    {
        $orders = new Order();

        if (!empty($request->page && $request->limit)) {
            $orders = new PaginatedOrderCollection($orders->with('dishes')->paginate($request->limit));
        } else {
            $orders = new OrderCollection($orders->with('dishes')->get());
        }

        return $this->successResponse($orders);
    }

    public function show(ShowRequest $request): JsonResponse
    {
        $order = Order::findOrFail($request->id);
        return $this->successResponse(new OrderResource($order));
    }

    public function storeOrUpdate(StoreOrUpdateRequest $request): JsonResponse
    {
        if($request->id) {
            $order = Order::find($request->id);
            if ($order->status == StatusEnum::Closed){
                return $this->errorResponse("Closed orders can/'t be updated");
            }
            $order->update($request->only('status'));
        }
        else {
            $order = Order::create($request->only('status'));
        }
        if ($request->dishes){
            $order->dishes()->sync(array_map(function ($dish){return (int)$dish['id'];},$request->dishes));
            foreach ($request->dishes as $dish){
                $order->dishes()->updateExistingPivot($dish['id'], ['amount' => $dish['amount']]);
            }
        }


        return $this->successResponse(new OrderResource($order));
    }

    public function destroy(DestroyRequest $request): JsonResponse
    {
        $order = Order::findOrFail($request->id);
        $order->delete();

        return $this->successResponse();
    }
}
