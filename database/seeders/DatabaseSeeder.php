<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Address;
use App\Models\Client;
use App\Models\Delivery;
use App\Models\DeliveryLine;
use App\Models\Route;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    private array $products = [
        'Maize',
        'Piens',
        'Ķirbis',
        'Dzeramais ūdens',
        'Slotaskāts',
        'Mazuts',
        'Slēpes ar abordāžas āķi',
        'Lietusūdens',
        'Gludeklis ar magnētiskās lentas piedziņu'
    ];

    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Client::factory(10)->create();

        foreach (Client::all() as $client) {
            $countOfAddresses = random_int(1, 2);
            for ($i = 0; $i < $countOfAddresses; $i++) {
                \App\Models\Address::factory()->create(['client_id' => $client->id]);
            }
        }

        \App\Models\Route::factory(30)->create();
        $this->addDeliveries();
    }

    private function addDeliveries()
    {
        $addresses = Address::all();

        foreach (Route::all() as $route) {

            $type = random_int(1, 2);

            $delivery = \App\Models\Delivery::factory()->create([
                'route_id' => $route->id,
                'address_id' => $addresses->get(random_int(0, $addresses->count() - 1))->id,
                'type' => $type,
                'status' => random_int(1, 3)
            ]);

            $countOfProducts = random_int(1, 4);
            for ($i = 0; $i < $countOfProducts; $i++) {

                $productIdx = array_rand($this->products);
                $productIdx |= 1;

                if ($type === Delivery::SOLID_PRODUCT) {
                    $productIdx ^= 1;
                } elseif ($productIdx === count($this->products)) {
                    $productIdx -= 2;
                }

                \App\Models\DeliveryLine::factory()->create([
                    'delivery_id' => $delivery->id,
                    'item' => $this->products[$productIdx],
                ]);
            }
        }
    }
}
