<?php

namespace Kdabrow\CryptoWorker\Http\Controllers;

use Kdabrow\CryptoWorker\Models\Exchange;
use Kdabrow\CryptoWorker\Http\Requests\StoreExchangeRequest;
use Kdabrow\CryptoWorker\Http\Requests\UpdateExchangeRequest;
use Kdabrow\CryptoWorker\Repositories\ExchangeRepository;
use Kdabrow\CryptoWorker\Http\Resources\ExchangeResource;
use \Illuminate\Http\JsonResponse;

class ExchangeController extends Controller 
{
    /** 
     * @OA\Get(
     *     path="/api/v1/exchanges",
     *     summary="Display the list of exchange items",
     *     @OA\Response(response=404, description="Not found"),
     *     @OA\Response(response=200, description="Ok", @OA\JsonContent(
     *           @OA\Property(property="data", type="array", @OA\Items(), ref="#/components/schemas/ExchangeResource")
     *     ))
     * )
     */
    public function index(ExchangeRepository $repository)
    {
        return ExchangeResource::collection($repository->paginateAll());
    }

    /**
     * @OA\Post(
     *     path="/api/v1/exchanges",
     *     summary="Store new exchange",
     *     @OA\RequestBody(@OA\JsonContent(@OA\Schema(ref="#/components/schemas/ExchangeStoreRequest"))),
     *     @OA\Response(response=422, description="Validation error"),
     *     @OA\Response(response=201, description="Created", @OA\JsonContent(@OA\Schema(ref="#/components/schemas/ExchangeResource")))
     * )
     */
    public function store(StoreExchangeRequest $request, ExchangeRepository $repository): JsonResponse
    {
        $exchange = $repository->create($request->validated());

        return response()->json(new ExchangeResource($exchange), 201);
    }

    /**
     * @OA\Get(
     *     path="/api/v1/exchanges/{exchange}",
     *     summary="Display the exchange",
     *     @OA\Parameter(description="Exchange id", in="path", name="exchange", required=true, @OA\Schema(type="string"), @OA\Examples(example="uuid", value="0006faf6-7a61-426c-9034-579f2cfcfa83", summary="An UUID value.")),
     *     @OA\Response(response=404, description="Not found"),
     *     @OA\Response(response=200, description="Ok", @OA\JsonContent(@OA\Schema(ref="#/components/schemas/ExchangeResource")))
     * )
     */
    public function show(Exchange $exchange): JsonResponse
    {
        return response()->json(new ExchangeResource($exchange));
    }

    /**
     * @OA\Put(
     *     path="/api/v1/exchanges/{exchange}",
     *     summary="Update the exchange",
     *     @OA\Parameter(description="Exchange id", in="path", name="exchange", required=true, @OA\Schema(type="string"), @OA\Examples(example="uuid", value="0006faf6-7a61-426c-9034-579f2cfcfa83", summary="An UUID value.")),
     *     @OA\RequestBody(@OA\JsonContent(@OA\Schema(ref="#/components/schemas/ExchangeUpdateRequest"))),
     *     @OA\Response(response=422, description="Validation error"),
     *     @OA\Response(response=404, description="Not found"),
     *     @OA\Response(response=200, description="Updated", @OA\JsonContent(@OA\Schema(ref="#/components/schemas/ExchangeResource")))
     * )
     */
    public function update(Exchange $exchange, UpdateExchangeRequest $request, ExchangeRepository $repository): JsonResponse
    {
        $exchange = $repository->update($exchange, $request->validated());

        return response()->json(new ExchangeResource($exchange));
    }

    /**
     * @OA\Delete(
     *     path="/api/v1/exchanges/{exchange}",
     *     summary="Remove the exchange",
     *     @OA\Parameter(description="Exchange id", in="path", name="exchange", required=true, @OA\Schema(type="string"), @OA\Examples(example="uuid", value="0006faf6-7a61-426c-9034-579f2cfcfa83", summary="An UUID value.")),
     *     @OA\Response(response=404, description="Not found"),
     *     @OA\Response(response=410, description="Resource already deleted"),
     *     @OA\Response(response=201, description="Deleted")
     * )
     */
    public function destroy(Exchange $exchange): JsonResponse
    {
        $count = $exchange->delete();
        if ($count) {
            return response()->json(new \stdClass, 201);
        }
        return response()->json(new \stdClass, 410);
    }
}