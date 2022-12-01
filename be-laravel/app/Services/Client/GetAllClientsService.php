<?php

namespace App\Services\Client;

use Illuminate\Database\Eloquent\Collection;

class GetAllClientsService extends ClientService
{
    public function execute(): Collection
    {
        return $this->clientRepository->getAllClients();
    }
}
