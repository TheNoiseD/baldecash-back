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
    public function index(): string
    {
        return response()->json([
           'users' => json_decode($this->userRepo->getAllUsers())
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): string
    {
        return $this->userRepo->createUser();

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): string
    {
        return $this->userRepo->getUserById($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(string $id): string
    {
        $user = User::find($id);
        return $this->userRepo->updateUser($user);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): string
    {
        $user = User::find($id);
        return $this->userRepo->deleteUser($user);
    }
}
