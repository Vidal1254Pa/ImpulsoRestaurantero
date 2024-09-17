<?php

namespace App\Interfaces;

use App\Models\Plan;
use App\Models\User;
use App\Models\UserPlan;
use Illuminate\Database\Eloquent\Collection;

interface IUserRepository
{
    public function create($request);
    public function update($request, $id);
    public function delete($id);
    public function all(): Collection;
    public function find($id): ?User;
    public function hasPlanByUserId($userId): bool;
    public function hasCompaniesByUserId($userId): bool;
    public function getCompaniesByUserId($userId): Collection;
    public function getPlanByUserId($userId): ?Plan;
    public function assignPlanToUser($userId, $planId);
}
