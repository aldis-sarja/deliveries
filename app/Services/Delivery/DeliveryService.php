<?php

namespace App\Services\Delivery;

use App\Repositories\Delivery\DeliveryRepositoryInterface;

abstract class DeliveryService
{
    protected const CACHE_TIME = 180;
    protected DeliveryRepositoryInterface $deliveryRepository;

    public function __construct(DeliveryRepositoryInterface $deliveryRepository)
    {
        $this->deliveryRepository = $deliveryRepository;
    }
}
