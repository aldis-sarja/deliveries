<?php

namespace App\Repositories\Client;

use App\Models\Address;
use App\Models\Client;
use App\Models\Delivery;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;

class ClientRepository implements ClientRepositoryInterface
{
    public function getAllClients(): Collection
    {
        return Client::all();
    }

    public function getClientById(int $id): Client
    {
        return Client::with(['addresses.deliveries.deliveryLines', 'addresses.deliveries.route'])
            ->findOrFail($id);
    }

    public function getClientAddresses(int $id): Collection
    {
        $addresses = Address::where('client_id', $id)->get();
        if ($addresses->count() < 1) {
            throw(new ModelNotFoundException("No query results for model [App\\Models\\Client] ${id}"));
        }
        return $addresses;
    }

    public function getClientsByDifferentDeliveries(): Collection
    {
        $filteredClients = new Collection();

        $clients = Client::with('addresses.deliveries')->get();

        foreach ($clients as $client) {
            $foundClient = false;

            foreach ($client->addresses as $address) {
                if (count($address->deliveries) > 1) {
                    $type = $address->deliveries->first()->type;
                    foreach ($address->deliveries as $delivery) {
                        if ($type !== $delivery->type) {
                            $filteredClients->push($client);
                            $foundClient = true;
                            break;
                        }
                    }
                }
                if ($foundClient) {
                    break;
                }
            }
        }
        return $filteredClients;
    }

    public function getClientsWithoutLiquidDeliveries(): Collection
    {
        $clients = Client::with('addresses.deliveries')->get();

        return $clients->reject(function ($client) {
            foreach ($client->addresses as $address) {
                if (isset($address->deliveries)) {
                    foreach ($address->deliveries as $delivery) {
                        if ($delivery->type === Delivery::LIQUID_PRODUCT) {
                            return true;
                        }
                    }
                }
            }
            return false;
        })->values(); // Normalise array indexes
    }
}
