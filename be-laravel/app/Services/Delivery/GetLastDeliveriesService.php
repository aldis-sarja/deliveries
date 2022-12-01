<?php

namespace App\Services\Delivery;

use Illuminate\Database\Eloquent\Collection;

class GetLastDeliveriesService extends DeliveryService
{
    public function execute(): Collection
    {
        return $this->deliveryRepository->getLastDeliveries();
    }
}
