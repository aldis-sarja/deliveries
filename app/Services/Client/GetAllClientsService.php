<?php

namespace App\Services\Client;

use Illuminate\Database\Eloquent\Collection;

class GetAllClientsService extends ClientService
{
    public function execute(): Collection
    {
        return cache()->remember("AllClients", self::CACHE_TIME, function () {
            return $this->clientRepository->getAllClients();
        });
    }
}
