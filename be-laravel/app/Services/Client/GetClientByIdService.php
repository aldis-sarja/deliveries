<?php

namespace App\Services\Client;

use App\Models\Client;

class GetClientByIdService extends ClientService
{
    public function execute(int $id): Client
    {
        return $this->clientRepository->getClientById($id);
    }
}
