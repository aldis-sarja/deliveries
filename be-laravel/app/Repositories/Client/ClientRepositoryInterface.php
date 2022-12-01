<?php

namespace App\Repositories\Client;

use App\Models\Client;
use Illuminate\Database\Eloquent\Collection;


interface ClientRepositoryInterface
{
    public function getAllClients(): Collection;
    public function getClientById(int $id): Client;
    public function getClientsByDifferentDeliveries(): Collection;
    public function getClientsByFilter(array $filter): Collection;
}
