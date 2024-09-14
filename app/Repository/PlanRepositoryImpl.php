<?php

namespace App\Repository;

use App\Interfaces\IPlanRepository;
use App\Models\Plan;
use App\Models\ProductsPlan;
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

    public function getProductsByPlanId(int $plan_id): Collection
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

    public function addProducts(int $plan_id, array $product_ids)
    {
        $plan = $this->_plan->find($plan_id);
        $plan->products()->attach($product_ids);
    }

    public function removeProductsByPlanId(int $plan_id)
    {
        ProductsPlan::where('plan_id', $plan_id)->delete();
    }
}
