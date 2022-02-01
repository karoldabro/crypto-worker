<?php

namespace Kdabrow\CryptoWorker\Http\Controllers;

use Kdabrow\CryptoWorker\Models\Order;
use Kdabrow\CryptoWorker\Http\Requests\StoreOrderRequest;
use Kdabrow\CryptoWorker\Http\Requests\UpdateOrderRequest;
use Kdabrow\CryptoWorker\Repositories\OrderRepository;
use Kdabrow\CryptoWorker\Http\Resources\OrderResource;
use \Illuminate\Http\JsonResponse;
use Kdabrow\CryptoWorker\Repositories\ActiveStrategyRepository;

class OrderController extends Controller
{
    /** 
     * @OA\Get(
     *     path="/api/v1/orders",
     *     summary="Display the list of order items",
     *     @OA\Response(response=404, description="Not found"),
     *     @OA\Response(response=200, description="Ok", @OA\JsonContent(
     *           @OA\Property(property="data", type="array", @OA\Items(), ref="#/components/schemas/OrderResource")
     *     ))
     * )
     */
    public function index(OrderRepository $repository)
    {
        return OrderResource::collection($repository->paginateAll());
    }

    /**
     * @OA\Post(
     *     path="/api/v1/orders",
     *     summary="Store new order",
     *     @OA\RequestBody(@OA\JsonContent(@OA\Schema(ref="#/components/schemas/OrderStoreRequest"))),
     *     @OA\Response(response=422, description="Validation error"),
     *     @OA\Response(response=201, description="Created", @OA\JsonContent(@OA\Schema(ref="#/components/schemas/OrderResource")))
     * )
     */
    public function store(StoreOrderRequest $request, OrderRepository $repository, ActiveStrategyRepository $activeStrategyRepository): JsonResponse
    {
        $activeStrategy = $activeStrategyRepository->find($request->input('active_strategy_id'));

        $order = $repository->create([
            ...$request->validated(), 
            'exchange_id' => $activeStrategy->exchange_id, 
            'strategy_id' => $activeStrategy->strategy_id,
        ]);

        return response()->json(new OrderResource($order), 201);
    }

    /**
     * @OA\Get(
     *     path="/api/v1/orders/{order}",
     *     summary="Display the order",
     *     @OA\Parameter(description="Order id", in="path", name="order", required=true, @OA\Schema(type="string"), @OA\Examples(example="uuid", value="0006faf6-7a61-426c-9034-579f2cfcfa83", summary="An UUID value.")),
     *     @OA\Response(response=404, description="Not found"),
     *     @OA\Response(response=200, description="Ok", @OA\JsonContent(@OA\Schema(ref="#/components/schemas/OrderResource")))
     * )
     */
    public function show(Order $order): JsonResponse
    {
        return response()->json(new OrderResource($order));
    }

    /**
     * @OA\Put(
     *     path="/api/v1/orders/{order}",
     *     summary="Update the order",
     *     @OA\Parameter(description="Order id", in="path", name="order", required=true, @OA\Schema(type="string"), @OA\Examples(example="uuid", value="0006faf6-7a61-426c-9034-579f2cfcfa83", summary="An UUID value.")),
     *     @OA\RequestBody(@OA\JsonContent(@OA\Schema(ref="#/components/schemas/OrderUpdateRequest"))),
     *     @OA\Response(response=422, description="Validation error"),
     *     @OA\Response(response=404, description="Not found"),
     *     @OA\Response(response=200, description="Updated", @OA\JsonContent(@OA\Schema(ref="#/components/schemas/OrderResource")))
     * )
     */
    public function update(Order $order, UpdateOrderRequest $request, OrderRepository $repository): JsonResponse
    {
        $order = $repository->update($order, $request->validated());

        return response()->json(new OrderResource($order));
    }

    /**
     * @OA\Delete(
     *     path="/api/v1/orders/{order}",
     *     summary="Remove the order",
     *     @OA\Parameter(description="Order id", in="path", name="order", required=true, @OA\Schema(type="string"), @OA\Examples(example="uuid", value="0006faf6-7a61-426c-9034-579f2cfcfa83", summary="An UUID value.")),
     *     @OA\Response(response=404, description="Not found"),
     *     @OA\Response(response=410, description="Resource already deleted"),
     *     @OA\Response(response=201, description="Deleted")
     * )
     */
    public function destroy(Order $order): JsonResponse
    {
        $count = $order->delete();
        if ($count) {
            return response()->json(new \stdClass, 201);
        }
        return response()->json(new \stdClass, 410);
    }
}
