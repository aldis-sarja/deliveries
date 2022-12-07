<?php

namespace App\Services\Client;

use App\Models\Client;

class GetClientByIdService extends ClientService
{
    public function execute(int $id): Client
    {
        return cache()->remember("Client:" . $id, self::CACHE_TIME, function () use ($id) {
            return $this->clientRepository->getClientById($id);
        });
    }
}
