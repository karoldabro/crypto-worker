<?php

namespace Kdabrow\CryptoWorker\Http\Controllers;

use Kdabrow\CryptoWorker\Models\User;
use Kdabrow\CryptoWorker\Http\Requests\StoreUserRequest;
use Kdabrow\CryptoWorker\Http\Requests\UpdateUserRequest;
use Kdabrow\CryptoWorker\Repositories\UserRepository;
use Kdabrow\CryptoWorker\Http\Resources\UserResource;
use \Illuminate\Http\JsonResponse;
use stdClass;

class UserController extends Controller 
{
    /** 
     * @OA\Get(
     *     path="/api/v1/users",
     *     summary="Display the list of user items",
     *     @OA\Response(response=404, description="Not found"),
     *     @OA\Response(response=200, description="Ok", @OA\JsonContent(
     *           @OA\Property(property="data", type="array", @OA\Items(), ref="#/components/schemas/UserResource")
     *     ))
     * )
     */
    public function index(UserRepository $repository)
    {
        return UserResource::collection($repository->paginateAll());
    }

    /**
     * @OA\Post(
     *     path="/api/v1/users",
     *     summary="Store new user",
     *     @OA\RequestBody(@OA\JsonContent(@OA\Schema(ref="#/components/schemas/UserStoreRequest"))),
     *     @OA\Response(response=201, description="Created", @OA\JsonContent(ref="#/components/schemas/UserResource")),
     *     @OA\Response(response=422, description="Validation error"),
     * )
     * 
     */
    public function store(StoreUserRequest $request, UserRepository $repository): JsonResponse
    {
        $user = $repository->create($request->validated());

        return response()->json(new UserResource($user), 201);
    }

    /**
     * @OA\Get(
     *     path="/api/v1/users/{user}",
     *     summary="Display the user",
     *     @OA\Parameter(description="User id", in="path", name="user", required=true, @OA\Schema(type="string"), @OA\Examples(example="uuid", value="0006faf6-7a61-426c-9034-579f2cfcfa83", summary="An UUID value.")),
     *     @OA\Response(response=404, description="Not found"),
     *     @OA\Response(response=200, description="Ok", @OA\JsonContent(@OA\Schema(ref="#/components/schemas/UserResource")))
     * )
     */
    public function show(User $user): JsonResponse
    {
        return response()->json(new UserResource($user));
    }

    /**
     * @OA\Put(
     *     path="/api/v1/users/{user}",
     *     summary="Update the user",
     *     @OA\Parameter(description="User id", in="path", name="user", required=true, @OA\Schema(type="string"), @OA\Examples(example="uuid", value="0006faf6-7a61-426c-9034-579f2cfcfa83", summary="An UUID value.")),
     *     @OA\RequestBody(@OA\JsonContent(@OA\Schema(ref="#/components/schemas/UserUpdateRequest"))),
     *     @OA\Response(response=422, description="Validation error"),
     *     @OA\Response(response=404, description="Not found"),
     *     @OA\Response(response=200, description="Updated", @OA\JsonContent(@OA\Schema(ref="#/components/schemas/UserResource")))
     * )
     */
    public function update(User $user, UpdateUserRequest $request, UserRepository $repository): JsonResponse
    {
        $user = $repository->update($user, $request->validated());

        return response()->json(new UserResource($user));
    }

    /**
     * @OA\Delete(
     *     path="/api/v1/users/{user}",
     *     summary="Remove the user",
     *     @OA\Parameter(description="User id", in="path", name="user", required=true, @OA\Schema(type="string"), @OA\Examples(example="uuid", value="0006faf6-7a61-426c-9034-579f2cfcfa83", summary="An UUID value.")),
     *     @OA\Response(response=404, description="Not found"),
     *     @OA\Response(response=410, description="Resource already deleted"),
     *     @OA\Response(response=201, description="Deleted")
     * )
     */
    public function destroy(User $user): JsonResponse
    {
        $count = $user->delete();
        if ($count) {
            return response()->json(new stdClass, 201);
        }
        return response()->json(new stdClass, 410);
    }
}