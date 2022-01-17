<?php

namespace Kdabrow\CryptoWorker\Http\Controllers;

use Kdabrow\CryptoWorker\Models\ActiveStrategy;
use Kdabrow\CryptoWorker\Http\Requests\StoreActiveStrategyRequest;
use Kdabrow\CryptoWorker\Http\Requests\UpdateActiveStrategyRequest;
use Kdabrow\CryptoWorker\Repositories\ActiveStrategyRepository;
use Kdabrow\CryptoWorker\Http\Resources\ActiveStrategyResource;
use \Illuminate\Http\JsonResponse;

class ActiveStrategyController extends Controller 
{
    /** 
     * @OA\Get(
     *     path="/api/v1/active_strategies",
     *     summary="Display the list of activestrategy items",
     *     @OA\Response(response=404, description="Not found"),
     *     @OA\Response(response=200, description="Ok", @OA\JsonContent(
     *           @OA\Property(property="data", type="array", @OA\Items(), ref="#/components/schemas/ActiveStrategyResource")
     *     ))
     * )
     */
    public function index(ActiveStrategyRepository $repository)
    {
        return ActiveStrategyResource::collection($repository->paginateAll());
    }

    /**
     * @OA\Post(
     *     path="/api/v1/active_strategies",
     *     summary="Store new activestrategy",
     *     @OA\RequestBody(@OA\JsonContent(@OA\Schema(ref="#/components/schemas/ActiveStrategyStoreRequest"))),
     *     @OA\Response(response=422, description="Validation error"),
     *     @OA\Response(response=201, description="Created", @OA\JsonContent(@OA\Schema(ref="#/components/schemas/ActiveStrategyResource")))
     * )
     */
    public function store(StoreActiveStrategyRequest $request, ActiveStrategyRepository $repository): JsonResponse
    {
        $activestrategy = $repository->create($request->validated());

        return response()->json(new ActiveStrategyResource($activestrategy), 201);
    }

    /**
     * @OA\Get(
     *     path="/api/v1/active_strategies/{activestrategy}",
     *     summary="Display the activestrategy",
     *     @OA\Parameter(description="ActiveStrategy id", in="path", name="activestrategy", required=true, @OA\Schema(type="string"), @OA\Examples(example="uuid", value="0006faf6-7a61-426c-9034-579f2cfcfa83", summary="An UUID value.")),
     *     @OA\Response(response=404, description="Not found"),
     *     @OA\Response(response=200, description="Ok", @OA\JsonContent(@OA\Schema(ref="#/components/schemas/ActiveStrategyResource")))
     * )
     */
    public function show(ActiveStrategy $activestrategy): JsonResponse
    {
        return response()->json(new ActiveStrategyResource($activestrategy));
    }

    /**
     * @OA\Put(
     *     path="/api/v1/active_strategies/{activestrategy}",
     *     summary="Update the activestrategy",
     *     @OA\Parameter(description="ActiveStrategy id", in="path", name="activestrategy", required=true, @OA\Schema(type="string"), @OA\Examples(example="uuid", value="0006faf6-7a61-426c-9034-579f2cfcfa83", summary="An UUID value.")),
     *     @OA\RequestBody(@OA\JsonContent(@OA\Schema(ref="#/components/schemas/ActiveStrategyUpdateRequest"))),
     *     @OA\Response(response=422, description="Validation error"),
     *     @OA\Response(response=404, description="Not found"),
     *     @OA\Response(response=200, description="Updated", @OA\JsonContent(@OA\Schema(ref="#/components/schemas/ActiveStrategyResource")))
     * )
     */
    public function update(ActiveStrategy $activestrategy, UpdateActiveStrategyRequest $request, ActiveStrategyRepository $repository): JsonResponse
    {
        $activestrategy = $repository->update($activestrategy, $request->validated());

        return response()->json(new ActiveStrategyResource($activestrategy));
    }

    /**
     * @OA\Delete(
     *     path="/api/v1/active_strategies/{activestrategy}",
     *     summary="Remove the activestrategy",
     *     @OA\Parameter(description="ActiveStrategy id", in="path", name="activestrategy", required=true, @OA\Schema(type="string"), @OA\Examples(example="uuid", value="0006faf6-7a61-426c-9034-579f2cfcfa83", summary="An UUID value.")),
     *     @OA\Response(response=404, description="Not found"),
     *     @OA\Response(response=410, description="Resource already deleted"),
     *     @OA\Response(response=201, description="Deleted")
     * )
     */
    public function destroy(ActiveStrategy $activestrategy): JsonResponse
    {
        $count = $activestrategy->delete();
        if ($count) {
            return response()->json(new \stdClass, 201);
        }
        return response()->json(new \stdClass, 410);
    }
}