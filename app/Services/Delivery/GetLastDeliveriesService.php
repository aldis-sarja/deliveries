<?php

namespace App\Services\Delivery;

use Illuminate\Database\Eloquent\Collection;

class GetLastDeliveriesService extends DeliveryService
{
    public function execute(): Collection
    {
        return cache()->remember("LastDeliveries", self::CACHE_TIME, function () {
            return $this->deliveryRepository->getLastDeliveries();
        });
    }
}
