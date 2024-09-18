<?php

namespace App\Repository;

use App\Interfaces\IProductRepository;
use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;

class ProductRepositoryImpl implements IProductRepository
{
    private Product $_product;
    public function __construct(Product $product)
    {
        $this->_product = $product;
    }

    public function all(): Collection
    {
        return $this->_product->all();
    }

    public function find($id): ?Product
    {
        return $this->_product->find($id);
    }

    public function create(array $data)
    {
        return $this->_product->create([
            'name' => $data['name'],
            'description' => $data['description'],
            'user_id' => $data['user_id'],
        ]);
    }

    public function update($id, array $data)
    {
        return $this->_product->find($id)->update([
            'name' => $data['name'],
            'description' => $data['description'],
        ]);
    }

    public function delete($id)
    {
        return $this->_product->find($id)->delete();
    }
}
