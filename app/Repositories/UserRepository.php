<?php

namespace App\Repositories;

use App\Interfaces\UserRepositoryInterface;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class UserRepository implements UserRepositoryInterface
{
    public Request $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function getAllUsers(): array
    {
        return User::with('role')->get()->toArray();
    }

    public function getUserById(int $id): array
    {
        $user = User::find($id);
        $role = $user->role->name;
        if (!$user){
            return [
                'message' => 'User not found',
                'status' => 404
            ];
        }
        return [
            'user' => $user,
            'role' => $role,
            'status' => 200
        ];
    }

    public function createUser():string
    {
        $errors = $this->validateField(new User(),true);
        if($errors){
            return [
                'message' => 'Validation failed',
                'errors' => $errors,
                'status' => 400
            ];
        }
        $user = new User();
        $user->fill($this->request->all('name', 'lastname', 'email', 'role_id'));
        $user->password = bcrypt($this->request->password);
        $user->save();
        return [
            'message' => 'User created successfully',
            'user' => $user,
            'status' => 201
        ];
    }

    public function updateUser(User $user):string
    {
        $errors = $this->validateField($user);
        if($errors){
            return [
                'message' => 'Validation failed',
                'errors' => $errors,
                'status' => 400
            ];
        }
        $user->fill($this->request->all('name', 'lastname', 'email', 'role_id'));
        if ($this->request->password && strlen($this->request->password)>0){
            $user->password = bcrypt($this->request->password);
        }
        $user->save();
        return [
            'message' => 'User updated successfully',
            'user' => $user,
            'status' => 200
        ];

    }

    public function deleteUser(User $user): string
    {
        $user->delete();
        return [
            'message' => 'User deleted successfully',
            'status' => 200
        ];
    }

    private function validateField($user,$new=false): array
    {
        $validate = new User();
        $validate->fill($this->request->all('name', 'lastname', 'email', 'password','confirm_password', 'role_id'));
        $errors = [];
        $validate->name ?? array_push($errors, ['name'=>'Name is required']);
        $validate->lastname ?? array_push($errors, ['lastname'=>'Lastname is required']);
        $validate->email ?? array_push($errors, ['email'=>'Email is required']);
        $validate->email && !filter_var($validate->email, FILTER_VALIDATE_EMAIL) ? $errors[] = ['email'=>'Email is invalid'] : null;
        $validate->email && $user->email != $validate->email && User::where('email', $validate->email)->first() ? $errors[] = ['email' => 'Email already exists'] : null;
        $validate->role_id ?? array_push($errors, ['role_id'=>'Role is required']);
        $validate->role_id && !Role::find($validate->role_id) ? $errors[] = ['role_id' => 'Role does not exist'] : null;
        if ($this->request->password && strlen($this->request->password)>0){
            $pattern = '/^.{8,}$/';
            !preg_match($pattern, $this->request->password) && $errors[] = ['password' => 'Password must contain at least 8 characters'];
        }
        if ($this->request->confirm_password && strlen($this->request->confirm_password)>0){
            if (!$this->request->password){
                $errors[] = ['password' => 'Password is required'];
            }

            if ($this->request->password != $this->request->confirm_password){
                $errors[] = ['confirm_password' => 'Passwords not match'];
            }
        }
        if ($new && !$this->request->password){
            $errors[] = ['password' => 'Password is required'];
        }

        $errors = array_map("unserialize", array_unique(array_map("serialize", $errors)));
        return $errors;
    }
}
