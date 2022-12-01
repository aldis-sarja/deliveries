<?php

namespace App\Services\Client;

use Illuminate\Database\Eloquent\Collection;

class GetClientsByFilterService extends ClientService
{
    public function execute(array $filters): Collection
    {
        return $this->clientRepository->getClientsByFilter($filters);
    }
}
