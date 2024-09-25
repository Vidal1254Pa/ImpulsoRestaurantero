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
    private User $_user;
    private Rol $_rol;
    private UserPlan $_userPlan;
    public function __construct(User $user, Rol $rol, UserPlan $userPlan)
    {
        $this->_user = $user;
        $this->_rol = $rol;
        $this->_userPlan = $userPlan;
    }

    public function create($request)
    {
        return $this->_user->create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role_id' => $request->role_id,
            'created_by' => $request->created_by
        ]);
    }

    public function update($request, $id)
    {
        $user = $this->_user->find($id);
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role_id' => $request->role_id
        ]);
    }

    public function delete($id)
    {
        $user = $this->_user->find($id);
        $user->delete();
    }

    public function all(): Collection
    {
        return $this->_user->all();
    }

    public function find($id): ?User
    {
        return $this->_user->find($id);
    }

    public function hasPlanByUserId($userId): bool
    {
        return $this->_user->find($userId)->plan()->exists();
    }

    public function getRolByUserId($userId): ?Rol
    {
        return $this->_rol->find($userId);
    }

    public function hasCompaniesByUserId($userId): bool
    {
        return $this->_user->find($userId)->companies()->exists();
    }

    public function getCompaniesByUserId($userId): Collection
    {
        return $this->_user->find($userId)->companies;
    }

    public function getPlanByUserId($userId): ?Plan
    {
        return $this->_user->find($userId)->plan->first();
    }

    public function assignPlanToUser($userId, $planId)
    {
        $this->_userPlan->create([
            'user_id' => $userId,
            'plan_id' => $planId,
            'start_date' => now(),
            'end_date' => now()->addMonth(),
        ]);
    }
}
