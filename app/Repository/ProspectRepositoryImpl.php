<?php

namespace App\Repository;

use App\Interfaces\IProspectRepository;
use App\Models\Prospect;
use Illuminate\Database\Eloquent\Collection;

class ProspectRepositoryImpl implements IProspectRepository
{
    private Prospect $_prospect;
    public function __construct(Prospect $prospect)
    {
        $this->_prospect = $prospect;
    }
    public function create(array $prospect)
    {
        return $this->_prospect->create([
            'name' => $prospect['name'],
            'email' => $prospect['email'],
            'phone' => $prospect['phone'],
            'company' => $prospect['company'],
            'website' => $prospect['website'],
            'message' => $prospect['message'],
            'state_attention' => $prospect['state_attention'],
        ]);
    }

    public function delete(int $id)
    {
        return $this->_prospect->where('id', $id)->delete();
    }

    public function all(): Collection
    {
        return $this->_prospect->all();
    }

    public function findByEmail(string $email):?Prospect
    {
        return $this->_prospect->where('email', $email)->first();
    }
}
