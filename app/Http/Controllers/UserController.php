<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Traits\HandleResponse;
use Illuminate\Http\Request;
use App\Http\Services\UserService;
use App\Http\Requests\UserStoreRequest;



class UserController extends Controller
{
    use HandleResponse;
  
    protected $userService;
    function __construct(UserService $userService)
    {
        $this->middleware('auth:api')->except('store');
        $this->userService = $userService;
    }

    public function index(Request $request)
    {

        return
            $this->handelResponse(
                200,
                $this->userService->getUsers($request)
            );
    }


    public function store(UserStoreRequest $request)
    {
        return $this->userService->storeUser($request->validated());
    }


    public function update(Request $request, User $user)
    {

        $user->name = $request->name;
        $user->save();

        return response()->json([
            'message' => 'success',
            'user' => $user
        ]);
    }

}
