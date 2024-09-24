<?php

namespace App\Repository;

use App\Interfaces\IPlanRepository;
use App\Models\ModulesPlan;
use App\Models\Plan;
use Illuminate\Database\Eloquent\Collection;

class PlanRepositoryImpl implements IPlanRepository
{
    private Plan $_plan;
    public function __construct(Plan $plan)
    {
        $this->_plan = $plan;
    }

    public function all(): Collection
    {
        return $this->_plan->all();
    }

    public function find($id): ?Plan
    {
        return $this->_plan->find($id);
    }

    public function getModulesByPlanId(int $plan_id): Collection
    {
        return $this->_plan->find($plan_id)->select('id', 'name', 'description', 'price')->with(['products' => function ($query) {
            $query->select('id', 'name');
        }])->get();
    }

    public function create(array $data)
    {
        return $this->_plan->create([
            'name' => $data['name'],
            'description' => $data['description'],
            'price' => $data['price'],
            'created_by' => $data['user_id'],
        ]);
    }

    public function update($id, array $data)
    {
        return $this->_plan->find($id)->update([
            'name' => $data['name'],
            'description' => $data['description'],
            'price' => $data['price'],
        ]);
    }

    public function delete($id)
    {
        return $this->_plan->find($id)->delete();
    }

    public function addModules(int $plan_id, array $module_ids, int $user_id)
    {
        $plan = $this->_plan->find($plan_id);
        $plan->products()->attach($module_ids, ['user_id' => $user_id]);
    }

    public function removeModulesByPlanId(int $plan_id)
    {
        ModulesPlan::where('plan_id', $plan_id)->delete();
    }
}
