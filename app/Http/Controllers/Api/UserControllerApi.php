<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterUserRequest;
use App\Http\Resources\UserResource;
use App\Services\UserService;
use Illuminate\Http\Request;
use App\Http\Requests\UpdateUserRequest;

class UserControllerApi extends Controller
{

    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function register(RegisterUserRequest $request)
    {
        $savedUser = $this->userService->register($request);
        return response()->json([
            'message' => 'Registrazione avvenuta con successo',
            'user' => new UserResource($savedUser)
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function userInfo(string $id)
    {
        $savedUser = $this->userService->getUser($id);
        return response()->json([
            'user' => new UserResource($savedUser)
        ]);
    }
    /**
     * Summary of allUserInfo
     * Only for ADMIN
     * @return \Illuminate\Http\JsonResponse
     */
    public function allUserInfo()
    {
        return response()->json([
            'user_list' => UserResource::collection($this->userService->getAllUser())
        ]);
    }

    /**
     * Update the specified resource in storage.
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateUserName(UpdateUserRequest $request, string $id)
    {
        $isUpdate = $this->userService->updateUserName($request, $id);
        return response()->json([
            'message' => ($isUpdate) ? "User succesfully updated" : "Fail to update the name",
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $isDeleted = $this->userService->deleteUser($id);
        return response()->json([
            'message' => ($isDeleted) ? "User succesfully deleted" : "Fail to delete the user",
        ]);
    }
}
