<?php

namespace App\Interfaces;

use App\Models\Plan;
use Illuminate\Database\Eloquent\Collection;

interface IPlanRepository
{
    public function all(): Collection;
    public function find($id): ?Plan;
    public function getProductsByPlanId(int $plan_id): Collection;
    public function create(array $data);
    public function update($id, array $data);
    public function delete($id);
    public function addProducts(int $plan_id, array $product_ids,int $user_id);
    public function removeProductsByPlanId(int $plan_id);
}
