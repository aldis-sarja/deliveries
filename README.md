# Deliveries app backend

Built with PHP, composer, Laravel 9
This is backend part of the app. For frontend look to [Deliveries frontend](https://github.com/aldis-sarja/deliveries-frontend.git)

## Installation

```bash
git clone https://github.com/aldis-sarja/deliveries.git
cd deliveries
composer install
```

Rename the file `.env.example` to `.env`, or make a copy:

```bash
cp .env.example .env
```

Configure your database:

```dosini
DB_CONNECTION=<your-db-server>
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=<your-db-name>
DB_USERNAME=<your-db-user-name>
DB_PASSWORD=<your-password>
```

Now initialize database and populate with sample records:

```bash
php artisan migrate
php artisan db:seed
```

Generate key for app

```bash
php artisan key:generate
```

## Usage

Run server:

```bash
php artisan serve
```

Install and run frontend part.

## API

-   `api/v1/clients` List of all clients.

```
{
    "id":
    "name":
    "phone":
    "email":
    "created_at":
    "updated_at":
}
```

---

-   `api/v1/clients/{id}/addresses` List of addresses for particular client.

```
{
    "id":
    "title":
    "client_id":
    "created_at":
    "updated_at":
    }
```

---

-   `api/v1/clients/different-deliveries` List of clients with deliveries, that contains both product types (solid and liquid).

```
{
    "id":
    "name":
    "phone":
    "email":
    "created_at":
    "updated_at":
    "addresses": [
        {
            "id":
            "title":
            "client_id":
            "created_at":
            "updated_at":
            "deliveries": [
                {
                    "id":
                    "route_id":
                    "address_id":
                    "type":
                    "status":
                    "created_at":
                    "updated_at":
                },
            ]
        },
    ]
}
```

Delivery type:

-   1: liquid
-   2: solid

Delivery status:

-   1: not finished
-   2: finished
-   3: canceled

---

-   `api/v1/clients/no-liquid-deliveries` List of clients who never received liquid products. The same output as for `different-deliveries`

-   `api/v1/deliveries/last` List of addresses with last delivery

```
{
    "name":
    "address":
    "deliveryDate":
    "deliveryType":
    "sum":
}
```

---

-   `api/v1/clients/{id}` All info of client with id

```
{
    "id":
    "name":
    "phone":
    "email":
    "created_at":
    "updated_at":
    "addresses": [
        {
            "id"
            "title":
            "client_id":
            "created_at":
            "updated_at":
            "deliveries": [
                {
                    "id":
                    "route_id":
                    "address_id":
                    "type":
                    "status":
                    "created_at":
                    "updated_at":
                    "delivery_lines": [
                        {
                            "id":
                            "delivery_id":
                            "item":
                            "price":
                            "qty":
                            "created_at":
                            "updated_at":
                        },
                    ],
                    "route": {
                        "id":
                        "date":
                        "car_number":
                        "status":
                        "driver_name":
                        "created_at":
                        "updated_at":
                    }
                },
            ]
        }
    ]
}
```

Route status:

-   1: created
-   2: planned
-   3: closed
