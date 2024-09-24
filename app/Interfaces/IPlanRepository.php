<?php

namespace App\Interfaces;

use App\Models\Plan;
use Illuminate\Database\Eloquent\Collection;

interface IPlanRepository
{
    public function all(): Collection;
    public function find($id): ?Plan;
    public function getModulesByPlanId(int $plan_id): Collection;
    public function create(array $data);
    public function update($id, array $data);
    public function delete($id);
    public function addModules(int $plan_id, array $module_ids,int $user_id);
    public function removeModulesByPlanId(int $plan_id);
}
