<?php

namespace App\Repository;

use App\Interfaces\IModuleRepository;
use App\Models\Module;
use Illuminate\Database\Eloquent\Collection;

class ModuleRepositoryImpl implements IModuleRepository
{
    private Module $_module;
    public function __construct(Module $module)
    {
        $this->_module = $module;
    }

    public function all(): Collection
    {
        return $this->_module->all();
    }

    public function find($id): ?Module
    {
        return $this->_module->find($id);
    }

    public function create(array $data)
    {
        return $this->_module->create([
            'name' => $data['name'],
            'description' => $data['description'],
            'user_id' => $data['user_id'],
        ]);
    }

    public function update($id, array $data)
    {
        return $this->_module->find($id)->update([
            'name' => $data['name'],
            'description' => $data['description'],
        ]);
    }

    public function delete($id)
    {
        return $this->_module->find($id)->delete();
    }
}
