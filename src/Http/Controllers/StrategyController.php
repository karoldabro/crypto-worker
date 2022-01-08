<?php

namespace Kdabrow\CryptoWorker\Http\Controllers;

use Kdabrow\CryptoWorker\Models\Strategy;
use Kdabrow\CryptoWorker\Http\Requests\StoreStrategyRequest;
use Kdabrow\CryptoWorker\Http\Requests\UpdateStrategyRequest;
use Kdabrow\CryptoWorker\Repositories\StrategyRepository;
use Kdabrow\CryptoWorker\Http\Resources\StrategyResource;
use \Illuminate\Http\JsonResponse;

class StrategyController extends Controller 
{
    /** 
     * @OA\Get(
     *     path="/api/v1/strategies",
     *     summary="Display the list of strategy items",
     *     @OA\Response(response=404, description="Not found"),
     *     @OA\Response(response=200, description="Ok", @OA\JsonContent(
     *           @OA\Property(property="data", type="array", @OA\Items(), ref="#/components/schemas/StrategyResource")
     *     ))
     * )
     */
    public function index(StrategyRepository $repository)
    {
        return StrategyResource::collection($repository->paginateAll());
    }

    /**
     * @OA\Post(
     *     path="/api/v1/strategies",
     *     summary="Store new strategy",
     *     @OA\RequestBody(@OA\JsonContent(@OA\Schema(ref="#/components/schemas/StrategyStoreRequest"))),
     *     @OA\Response(response=422, description="Validation error"),
     *     @OA\Response(response=201, description="Created", @OA\JsonContent(@OA\Schema(ref="#/components/schemas/StrategyResource")))
     * )
     */
    public function store(StoreStrategyRequest $request, StrategyRepository $repository): JsonResponse
    {
        $strategy = $repository->create($request->validated());

        return response()->json(new StrategyResource($strategy), 201);
    }

    /**
     * @OA\Get(
     *     path="/api/v1/strategies/{strategy}",
     *     summary="Display the strategy",
     *     @OA\Parameter(description="Strategy id", in="path", name="strategy", required=true, @OA\Schema(type="string"), @OA\Examples(example="uuid", value="0006faf6-7a61-426c-9034-579f2cfcfa83", summary="An UUID value.")),
     *     @OA\Response(response=404, description="Not found"),
     *     @OA\Response(response=200, description="Ok", @OA\JsonContent(@OA\Schema(ref="#/components/schemas/StrategyResource")))
     * )
     */
    public function show(Strategy $strategy): JsonResponse
    {
        return response()->json(new StrategyResource($strategy));
    }

    /**
     * @OA\Put(
     *     path="/api/v1/strategies/{strategy}",
     *     summary="Update the strategy",
     *     @OA\Parameter(description="Strategy id", in="path", name="strategy", required=true, @OA\Schema(type="string"), @OA\Examples(example="uuid", value="0006faf6-7a61-426c-9034-579f2cfcfa83", summary="An UUID value.")),
     *     @OA\RequestBody(@OA\JsonContent(@OA\Schema(ref="#/components/schemas/StrategyUpdateRequest"))),
     *     @OA\Response(response=422, description="Validation error"),
     *     @OA\Response(response=404, description="Not found"),
     *     @OA\Response(response=200, description="Updated", @OA\JsonContent(@OA\Schema(ref="#/components/schemas/StrategyResource")))
     * )
     */
    public function update(Strategy $strategy, UpdateStrategyRequest $request, StrategyRepository $repository): JsonResponse
    {
        $strategy = $repository->update($strategy, $request->validated());

        return response()->json(new StrategyResource($strategy));
    }

    /**
     * @OA\Delete(
     *     path="/api/v1/strategies/{strategy}",
     *     summary="Remove the strategy",
     *     @OA\Parameter(description="Strategy id", in="path", name="strategy", required=true, @OA\Schema(type="string"), @OA\Examples(example="uuid", value="0006faf6-7a61-426c-9034-579f2cfcfa83", summary="An UUID value.")),
     *     @OA\Response(response=404, description="Not found"),
     *     @OA\Response(response=410, description="Resource already deleted"),
     *     @OA\Response(response=201, description="Deleted")
     * )
     */
    public function destroy(Strategy $strategy): JsonResponse
    {
        $count = $strategy->delete();
        if ($count) {
            return response()->json(new \stdClass, 201);
        }
        return response()->json(new \stdClass, 410);
    }
}