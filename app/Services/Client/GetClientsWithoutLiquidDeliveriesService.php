<?php

namespace App\Services\Client;

use Illuminate\Database\Eloquent\Collection;

class GetClientsWithoutLiquidDeliveriesService extends ClientService
{
    public function execute(): Collection
    {
        return cache()->remember("NoLiquid:", self::CACHE_TIME, function () {
            return $this->clientRepository->getClientsWithoutLiquidDeliveries();
        });
    }
}
