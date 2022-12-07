<?php

namespace App\Services\Client;

use Illuminate\Database\Eloquent\Collection;

class GetClientsByDifferentDeliveriesService extends ClientService
{
    public function execute(): Collection
    {
        return cache()->remember("Different", self::CACHE_TIME, function () {
            return $this->clientRepository->getClientsByDifferentDeliveries();
        });
    }
}
