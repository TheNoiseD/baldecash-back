<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;

class UserController extends Controller
{
    private UserRepository $userRepo;

    public function __construct(UserRepository $userRepo)
    {
        $this->userRepo = $userRepo;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $response = [
            'users' => $this->userRepo->getAllUsers(),
            'status' => 200
        ];

        return json_encode($response);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): string
    {
        $response = $this->userRepo->createUser();
        return json_encode($response);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): string
    {
        $response = $this->userRepo->getUserById($id);
        return json_encode($response);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(string $id): string
    {
        $user = User::find($id);
        $response = $this->userRepo->updateUser($user);
        return json_encode($response);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): string
    {
        $user = User::find($id);
        $response = $this->userRepo->deleteUser($user);
        return json_encode($response);
    }
}
