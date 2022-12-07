<?php

namespace App\Repositories\Delivery;

use App\Models\Address;
use App\Models\Client;
use App\Models\ClientData;
use App\Models\Delivery;
use App\Models\DeliveryLine;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class DeliveryRepository implements DeliveryRepositoryInterface
{
    public function getLastDeliveries(): Collection
    {
        $deliveries = Delivery::with('route')
            ->orderBy('address_id')
            ->get();

        $clients = new Collection();

        if ($deliveries->count() < 1) {
            throw(new ModelNotFoundException("No query results for model [App\\Models\\Delivery]"));
        }

        $addressId = $deliveries->first()->address_id;
        $date = $deliveries->first()->route->date;
        $deliveryIdx = 0;

        foreach ($deliveries as $idx => $delivery) {
            if ($delivery->address_id !== $addressId) {

                $clients->push($this->makeClientData($deliveries->get($deliveryIdx), $addressId));
                $addressId = $delivery->address_id;
                $date = $delivery->route->date;
                $deliveryIdx = $idx;
            }
            if ($date < $delivery->route->date) {
                $date = $delivery->route->date;
                $deliveryIdx = $idx;
            }
        }
        $clients->push($this->makeClientData($deliveries->get($deliveryIdx), $addressId));
        return $clients;
    }

    private function makeClientData(Delivery $delivery, int $addressId): ClientData
    {
        $address = Address::findOrFail($addressId);
        $client = Client::findOrFail($address->client_id);
        $deliveryLines = DeliveryLine::where('delivery_id', $delivery->id)->get();

        return new ClientData([
            'name' => $client->name,
            'address' => $address->title,
            'deliveryDate' => $delivery->route->date,
            'deliveryType' => $delivery->type,
            'sum' => $deliveryLines->reduce(function ($sum, $deliveryLine) {
                return $sum + $deliveryLine->price * $deliveryLine->qty;
            })
        ]);
    }
}
