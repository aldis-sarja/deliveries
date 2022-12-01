<?php

namespace App\Repositories\Delivery;

use App\Models\Delivery;
use Illuminate\Database\Eloquent\Collection;


interface DeliveryRepositoryInterface
{
    public function getLastDeliveries(): Collection;
}
