<?php

namespace App\Repositories\Client;

use App\Models\Client;
use Illuminate\Database\Eloquent\Collection;


interface ClientRepositoryInterface
{
    public function getAllClients(): Collection;
    public function getClientById(int $id): Client;
    public function getClientAddresses(int $id): Collection;
    public function getClientsByDifferentDeliveries(): Collection;
    public function getClientsWithoutLiquidDeliveries(): Collection;
}
