<?php

namespace App\Services;

use App\Interfaces\IProspectRepository;
use App\Shared\OnExecuteServiceAwaitResponse;
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
        $instance = $this->_prospectRepository->create($prospect);
        return OnExecuteServiceAwaitResponse::success(
            code: 201,
            dataInjected: ['id' => $instance->id]
        );
    }

    public function delete(int $id)
    {
        $this->_prospectRepository->delete($id);
        return OnExecuteServiceAwaitResponse::success(
            code: 200,
        );
    }

    public function all()
    {
        return OnExecuteServiceAwaitResponse::success(
            dataInjected: ['data' => $this->_prospectRepository->all()],
            withOutMessage: true,
            code: 200
        );
    }

    public function findByEmail(string $email)
    {
        $instance = $this->_prospectRepository->findByEmail($email);
        if ($instance) {
            throw new Exception("Prospect with email $email already exists");
        }
    }
}
