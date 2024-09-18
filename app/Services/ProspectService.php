<?php

namespace App\Services;

use App\Interfaces\IProspectRepository;
use App\Shared\StateAttention;
use Exception;
use Illuminate\Support\Facades\Validator;

class ProspectService
{
    private IProspectRepository $_prospectRepository;

    public function __construct(IProspectRepository $prospectRepository)
    {
        $this->_prospectRepository = $prospectRepository;
    }

    public function create(array $prospect)
    {
        Validator::make(
            $prospect,
            [
                'name' => 'required|string',
                'email' => 'required|email',
                'phone' => 'required|string',
                'company' => 'required|string',
                'website' => 'required|string',
                'message' => 'required|string',
            ]
        )->validate();
        $prospect['state_attention'] = StateAttention::PENDING;
        $this->findByEmail($prospect['email']);
        return $this->_prospectRepository->create($prospect);
    }

    public function delete(int $id)
    {
        return $this->_prospectRepository->delete($id);
    }

    public function all()
    {
        return $this->_prospectRepository->all();
    }

    public function findByEmail(string $email)
    {
        $instance = $this->_prospectRepository->findByEmail($email);
        if ($instance) {
            throw new Exception("Prospect with email $email already exists");
        }
    }
}
