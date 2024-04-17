<?php

namespace App\Interfaces;

use App\Models\User;

interface UserRepositoryInterface
{
    public function getAllUsers();
    public function getUserById(int $id);
    public function createUser();
    public function updateUser(User $user);
    public function deleteUser(User $user);
}
