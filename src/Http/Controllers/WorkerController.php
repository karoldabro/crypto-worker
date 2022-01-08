<?php

namespace Kdabrow\CryptoWorker\Http\Controllers;

use Kdabrow\CryptoWorker\Models\Worker;
use Kdabrow\CryptoWorker\Http\Requests\StoreWorkerRequest;
use Kdabrow\CryptoWorker\Http\Requests\UpdateWorkerRequest;
use Kdabrow\CryptoWorker\Repositories\WorkerRepository;
use Kdabrow\CryptoWorker\Http\Resources\WorkerResource;
use \Illuminate\Http\JsonResponse;

class WorkerController extends Controller 
{
    /** 
     * @OA\Get(
     *     path="/api/v1/workers",
     *     summary="Display the list of worker items",
     *     @OA\Response(response=404, description="Not found"),
     *     @OA\Response(response=200, description="Ok", @OA\JsonContent(
     *           @OA\Property(property="data", type="array", @OA\Items(), ref="#/components/schemas/WorkerResource")
     *     ))
     * )
     */
    public function index(WorkerRepository $repository)
    {
        return WorkerResource::collection($repository->paginateAll());
    }

    /**
     * @OA\Post(
     *     path="/api/v1/workers",
     *     summary="Store new worker",
     *     @OA\RequestBody(@OA\JsonContent(@OA\Schema(ref="#/components/schemas/WorkerStoreRequest"))),
     *     @OA\Response(response=422, description="Validation error"),
     *     @OA\Response(response=201, description="Created", @OA\JsonContent(@OA\Schema(ref="#/components/schemas/WorkerResource")))
     * )
     */
    public function store(StoreWorkerRequest $request, WorkerRepository $repository): JsonResponse
    {
        $worker = $repository->create($request->validated());

        return response()->json(new WorkerResource($worker), 201);
    }

    /**
     * @OA\Get(
     *     path="/api/v1/workers/{worker}",
     *     summary="Display the worker",
     *     @OA\Parameter(description="Worker id", in="path", name="worker", required=true, @OA\Schema(type="string"), @OA\Examples(example="uuid", value="0006faf6-7a61-426c-9034-579f2cfcfa83", summary="An UUID value.")),
     *     @OA\Response(response=404, description="Not found"),
     *     @OA\Response(response=200, description="Ok", @OA\JsonContent(@OA\Schema(ref="#/components/schemas/WorkerResource")))
     * )
     */
    public function show(Worker $worker): JsonResponse
    {
        return response()->json(new WorkerResource($worker));
    }

    /**
     * @OA\Put(
     *     path="/api/v1/workers/{worker}",
     *     summary="Update the worker",
     *     @OA\Parameter(description="Worker id", in="path", name="worker", required=true, @OA\Schema(type="string"), @OA\Examples(example="uuid", value="0006faf6-7a61-426c-9034-579f2cfcfa83", summary="An UUID value.")),
     *     @OA\RequestBody(@OA\JsonContent(@OA\Schema(ref="#/components/schemas/WorkerUpdateRequest"))),
     *     @OA\Response(response=422, description="Validation error"),
     *     @OA\Response(response=404, description="Not found"),
     *     @OA\Response(response=200, description="Updated", @OA\JsonContent(@OA\Schema(ref="#/components/schemas/WorkerResource")))
     * )
     */
    public function update(Worker $worker, UpdateWorkerRequest $request, WorkerRepository $repository): JsonResponse
    {
        $worker = $repository->update($worker, $request->validated());

        return response()->json(new WorkerResource($worker));
    }

    /**
     * @OA\Delete(
     *     path="/api/v1/workers/{worker}",
     *     summary="Remove the worker",
     *     @OA\Parameter(description="Worker id", in="path", name="worker", required=true, @OA\Schema(type="string"), @OA\Examples(example="uuid", value="0006faf6-7a61-426c-9034-579f2cfcfa83", summary="An UUID value.")),
     *     @OA\Response(response=404, description="Not found"),
     *     @OA\Response(response=410, description="Resource already deleted"),
     *     @OA\Response(response=201, description="Deleted")
     * )
     */
    public function destroy(Worker $worker): JsonResponse
    {
        $count = $worker->delete();
        if ($count) {
            return response()->json(new \stdClass, 201);
        }
        return response()->json(new \stdClass, 410);
    }
}