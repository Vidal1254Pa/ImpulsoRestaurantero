<?php

namespace App\Repository;

use App\Interfaces\IUserRepository;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

class UserRepositoryImpl implements IUserRepository
{
    private User $_userDb;
    public function __construct(User $userDb)
    {
        $this->_userDb = $userDb;
    }
    public function create($request)
    {
        $this->_userDb->create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role_id' => $request->role_id
        ]);
    }

    public function update($request, $id)
    {
        $user = $this->_userDb->find($id);
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role_id' => $request->role_id
        ]);
    }

    public function delete($id)
    {
        $user = $this->_userDb->find($id);
        $user->delete();
    }

    public function all(): Collection
    {
        return $this->_userDb->all();
    }

    public function find($id): ?User
    {
        return $this->_userDb->find($id);
    }
}
