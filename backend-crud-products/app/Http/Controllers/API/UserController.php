<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Repositories\UserRepository;
use App\Http\Requests\UserSaveRequest;
use Auth;

class UserController extends Controller
{
    protected $userRepository;

    public function __construct(
        UserRepository $userRepository
    ) {
        $this->userRepository = $userRepository;
    }

    public function login()
    {
        $credentials = request(['email', 'password']);

        if (auth()->attempt($credentials)) {
            $auth = Auth::user();
            $user['token'] = $auth->createToken('ApiToken')->plainTextToken;
            $user['name'] = $auth->name;

            return response()->json([
                'success'   => true,
                'message'   => 'Login Success',
                'data'      => $user
            ], 200);
            
        }else {
            return response()->json([
                'success'   => false,
                'message' => 'These credentials do not match our records'
            ], 401);
        }
    }

    public function getAllUsers()
    {
        $users = $this->userRepository->index();

        return response()->json([
            'success'   => true,
            'message'   => 'List Data Users',
            'data'      => $users
        ], 200);
    }

    public function createUser(UserSaveRequest $request)
    {
        $user = $this->userRepository->create($request);

        return response()->json([
            'success'   => true,
            'message'   => 'User Successfully Created',
            'data'      => $user
        ], 201);
    }

    public function updateUser(UserSaveRequest $request, $id)
    {
        $user = $this->userRepository->update($request, $id);

        return response()->json([
            'success'   => true,
            'message'   => 'User Successfully updated',
            'data'      => $user
        ], 201);
    }

    public function getUserById($id)
    {
        $user = $this->userRepository->fetchById($id);

        if(!$user){
            return response()->json([
                'success'   => false,
                'message' => 'Data Not Found'
            ], 404);
        }

        return response()->json([
            'success'   => true,
            'message'   => 'Data User ' . $user->name,
            'data'      => $user
        ], 200);
    }

    public function deleteUser($id)
    {
        $this->userRepository->delete($id);

        return response()->json([
            'success'   => true,
            'message' => 'User Successfully deleted'
        ], 200);
    }
}
