<?php

namespace Kdabrow\CryptoWorker\Http\Controllers;

use Kdabrow\CryptoWorker\Models\Kline;
use Kdabrow\CryptoWorker\Http\Requests\StoreKlineRequest;
use Kdabrow\CryptoWorker\Http\Requests\UpdateKlineRequest;
use Kdabrow\CryptoWorker\Repositories\KlineRepository;
use Kdabrow\CryptoWorker\Http\Resources\KlineResource;
use \Illuminate\Http\JsonResponse;

class KlineController extends Controller 
{
    /** 
     * @OA\Get(
     *     path="/api/v1/klines",
     *     summary="Display the list of kline items",
     *     @OA\Response(response=404, description="Not found"),
     *     @OA\Response(response=200, description="Ok", @OA\JsonContent(
     *           @OA\Property(property="data", type="array", @OA\Items(), ref="#/components/schemas/KlineResource")
     *     ))
     * )
     */
    public function index(KlineRepository $repository)
    {
        return KlineResource::collection($repository->paginateAll());
    }

    /**
     * @OA\Post(
     *     path="/api/v1/klines",
     *     summary="Store new kline",
     *     @OA\RequestBody(@OA\JsonContent(@OA\Schema(ref="#/components/schemas/KlineStoreRequest"))),
     *     @OA\Response(response=422, description="Validation error"),
     *     @OA\Response(response=201, description="Created", @OA\JsonContent(@OA\Schema(ref="#/components/schemas/KlineResource")))
     * )
     */
    public function store(StoreKlineRequest $request, KlineRepository $repository): JsonResponse
    {
        $kline = $repository->create($request->validated());

        return response()->json(new KlineResource($kline), 201);
    }

    /**
     * @OA\Get(
     *     path="/api/v1/klines/{kline}",
     *     summary="Display the kline",
     *     @OA\Parameter(description="Kline id", in="path", name="kline", required=true, @OA\Schema(type="string"), @OA\Examples(example="uuid", value="0006faf6-7a61-426c-9034-579f2cfcfa83", summary="An UUID value.")),
     *     @OA\Response(response=404, description="Not found"),
     *     @OA\Response(response=200, description="Ok", @OA\JsonContent(@OA\Schema(ref="#/components/schemas/KlineResource")))
     * )
     */
    public function show(Kline $kline): JsonResponse
    {
        return response()->json(new KlineResource($kline));
    }

    /**
     * @OA\Put(
     *     path="/api/v1/klines/{kline}",
     *     summary="Update the kline",
     *     @OA\Parameter(description="Kline id", in="path", name="kline", required=true, @OA\Schema(type="string"), @OA\Examples(example="uuid", value="0006faf6-7a61-426c-9034-579f2cfcfa83", summary="An UUID value.")),
     *     @OA\RequestBody(@OA\JsonContent(@OA\Schema(ref="#/components/schemas/KlineUpdateRequest"))),
     *     @OA\Response(response=422, description="Validation error"),
     *     @OA\Response(response=404, description="Not found"),
     *     @OA\Response(response=200, description="Updated", @OA\JsonContent(@OA\Schema(ref="#/components/schemas/KlineResource")))
     * )
     */
    public function update(Kline $kline, UpdateKlineRequest $request, KlineRepository $repository): JsonResponse
    {
        $kline = $repository->update($kline, $request->validated());

        return response()->json(new KlineResource($kline));
    }

    /**
     * @OA\Delete(
     *     path="/api/v1/klines/{kline}",
     *     summary="Remove the kline",
     *     @OA\Parameter(description="Kline id", in="path", name="kline", required=true, @OA\Schema(type="string"), @OA\Examples(example="uuid", value="0006faf6-7a61-426c-9034-579f2cfcfa83", summary="An UUID value.")),
     *     @OA\Response(response=404, description="Not found"),
     *     @OA\Response(response=410, description="Resource already deleted"),
     *     @OA\Response(response=201, description="Deleted")
     * )
     */
    public function destroy(Kline $kline): JsonResponse
    {
        $count = $kline->delete();
        if ($count) {
            return response()->json(new \stdClass, 201);
        }
        return response()->json(new \stdClass, 410);
    }
}