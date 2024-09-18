<?php

namespace App\Repository;

use App\Interfaces\IUserRepository;
use App\Models\Plan;
use App\Models\User;
use App\Models\UserPlan;
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
            'role_id' => $request->role_id,
            'created_by' => $request->created_by
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

    public function hasPlanByUserId($userId): bool
    {
        return $this->_userDb->find($userId)->plan()->exists();
    }

    public function hasCompaniesByUserId($userId): bool
    {
        return $this->_userDb->find($userId)->companies()->exists();
    }

    public function getCompaniesByUserId($userId): Collection
    {
        return $this->_userDb->find($userId)->companies;
    }

    public function getPlanByUserId($userId): ?Plan
    {
        return $this->_userDb->find($userId)->plan;
    }

    public function assignPlanToUser($userId, $planId)
    {
        $instace = User::find($userId);
        $instace->plan_id = $planId;
        $instace->save();
    }
}
