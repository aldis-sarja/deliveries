<?php

namespace App\Services\Client;

use Illuminate\Database\Eloquent\Collection;

class GetClientAddressesService extends ClientService
{
    public function execute(int $id): Collection
    {
        return cache()->remember("Client:Addresses:" . $id, self::CACHE_TIME, function () use ($id) {
            return $this->clientRepository->getClientAddresses($id);
        });
    }
}
