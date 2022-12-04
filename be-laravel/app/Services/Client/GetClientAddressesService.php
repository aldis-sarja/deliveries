<?php

namespace App\Services\Client;

use Illuminate\Database\Eloquent\Collection;

class GetClientAddressesService extends ClientService
{
    public function execute(int $id): Collection
    {
        return $this->clientRepository->getClientAddresses($id);
    }
}
