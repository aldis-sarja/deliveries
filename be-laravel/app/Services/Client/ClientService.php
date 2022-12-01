<?php

namespace App\Services\Client;

use App\Repositories\Client\ClientRepositoryInterface;

abstract class ClientService
{
    protected ClientRepositoryInterface $clientRepository;

    public function __construct(ClientRepositoryInterface $clientRepository)
    {
        $this->clientRepository = $clientRepository;
    }
}
