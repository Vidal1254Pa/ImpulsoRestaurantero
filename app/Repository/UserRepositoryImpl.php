<?php

namespace App\Repository;

use App\Interfaces\IUserRepository;
use App\Models\Plan;
use App\Models\Rol;
use App\Models\User;
use App\Models\UserPlan;
use Illuminate\Database\Eloquent\Collection;

class UserRepositoryImpl implements IUserRepository
{
    private User $_userDb;
    private Rol $_rolDb;
    private UserPlan $_userPlanDb;
    public function __construct(User $userDb, Rol $rolDb, UserPlan $userPlanDb)
    {
        $this->_userDb = $userDb;
        $this->_rolDb = $rolDb;
        $this->_userPlanDb = $userPlanDb;
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

    public function getRolByUserId($userId): ?Rol
    {
        return $this->_rolDb->find($userId);
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
        return $this->_userDb->find($userId)->plan->first();
    }

    public function assignPlanToUser($userId, $planId)
    {
        $this->_userPlanDb->create([
            'user_id' => $userId,
            'plan_id' => $planId,
            'start_date' => now(),
            'end_date' => now()->addMonth(),
        ]);
    }
}
