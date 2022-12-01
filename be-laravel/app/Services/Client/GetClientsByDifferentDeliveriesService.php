<?php

namespace App\Services\Client;

use Illuminate\Database\Eloquent\Collection;

class GetClientsByDifferentDeliveriesService extends ClientService
{
    public function execute(): Collection
    {
        return $this->clientRepository->getClientsByDifferentDeliveries();
    }
}
