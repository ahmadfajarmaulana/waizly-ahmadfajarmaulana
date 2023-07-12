<?php
namespace App\Repositories;

use App\Models\User;


class UserRepository
{
    public function index()
    {
        $users = User::selectRaw('id, name, email, role_id')->with('role')->get();
        
        return $users;
    }

    public function create($request)
    {
        $user = User::create([
            'name'      => $request->name,
            'email'     => $request->email,
            'password'  => bcrypt($request->password),
            'role_id'   => $request->role_id ?? null
        ]);

        return $user;
    }

    public function update($request, $id)
    {
        $user = $this->fetchById($id);

        $user->update([
            'name'      => $request->name,
            'email'     => $request->email,
            'password'  => bcrypt($request->password),
            'role_id'   => $request->role_id
        ]);

        return $user->fresh();
    }
    
    public function fetchById($id)
    {
        $user = User::with('role')->find($id);

        return $user;
    }

    public function delete($id)
    {
        $category = $this->fetchById($id);

        $category->delete($id);

        return $category;
    }
}