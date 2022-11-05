# Restaurant Laravel API

This is a simple project where you can manage dishes and orders.

## Running the API

It's very simple to get the API up and running. First, create the database (and database
user if necessary) and add them to the `.env` file.

```
DB_DATABASE=your_db_name
DB_USERNAME=your_db_user
DB_PASSWORD=your_password
```

Then:

1. Install dependencies:
   `composer install`
2. Migrate database:
   `php artisan migrate`
3. If you need to insert to database a bunch of randomly generated dishes, run:
   `php artisan db:seed`
4. Run server:
   `php artisan serve`

The API will be running on `localhost:8000`.

## Using the API

### Get list of Dishes

#### Request

`GET http://localhost:8000//api/dish/`

    curl --location -g --request GET 'http://localhost:8000//api/dish/' 
    --header 'Accept: application/json'

#### Response

    {
        "data": {
            "data": [
                {
                    "id": 1,
                    "name": "a",
                    "price": 74.83
                },
                {
                    "id": 2,
                    "name": "vitae",
                    "price": 597.51
                },
                {
                    "id": 3,
                    "name": "reprehenderit",
                    "price": 807.33
                }
            ]
        }
    }

#### Optional Parameters

These parameters are not required, but are possible to add:

1. `page` - page of paginated data. Required with `limit`.
2. `limit` - amount of records on page. Required with `page`.
3. `order_by` - orders records by parameter. Available parameters are `name` and `price`.

### Create new Dish

#### Request

`POST http://localhost:8000//api/dish/`

    curl --location --request POST 'http://localhost:8000//api/dish' 
    --header 'Accept: application/json' 
    --form 'name="spam and scrambled eggs"' 
    --form 'price="420.99"'

#### Response

    {
        "data": {
            "id": 11,
            "name": "spam and scrambled eggs",
            "price": "420.99",
            "updated_at": "2022-11-05T12:49:51.000000Z"
        }
    }


#### Required Parameters

Include all the following POST parameters when you request the url:

1. `name` - this will be the name of dish.
2. `price` - this will be the price of dish.

### Update specific Dish

#### Request

`POST http://localhost:8000//api/dish/{{id}}`

    curl --location --request POST 'http://localhost:8000//api/dish/1' 
    --header 'Accept: application/json' 
    --form 'name="spam and scrambled eggs"' 
    --form 'price="480.99"'

#### Response

    {
        "data": {
            "id": 1,
            "name": "spam and scrambled eggs",
            "price": "480.99",
            "updated_at": "2022-11-05T13:01:24.000000Z"
        }
    }

#### Optional Parameters

These parameters are not required, but are possible to add:

1. `name` - this will be a new name of the dish.
2. `price` - this will be a new price of the dish.

### Delete specific Dish

#### Request

`DELETE http://localhost:8000//api/dish/{{id}}`

    curl --location --request DELETE 'http://localhost:8000//api/dish/1' 
    --header 'Accept: application/json' 

#### Response

    {
        "data": null
    }

### Get list of Orders

#### Request

`GET http://localhost:8000//api/order/`

    curl --location -g --request GET 'http://localhost:8000//api/order/' 
    --header 'Accept: application/json'

#### Response

    {
        "data": {
            "data": [
                {
                    "id": 1,
                    "status": "opened",
                    "updated_at": "2022-11-05T14:31:27.000000Z",
                    "total": 5633.25
                },
                {
                    "id": 2,
                    "status": "opened",
                    "updated_at": "2022-11-05T14:31:27.000000Z",
                    "total": 1852.92
                },
                {
                    "id": 3,
                    "status": "closed",
                    "updated_at": "2022-11-05T14:31:27.000000Z",
                    "total": 6298.400000000001
                },
                
            ]
        }
    }

#### Optional Parameters

These parameters are not required, but are possible to add:

1. `page` - page of paginated data. Required with `limit`.
2. `limit` - amount of records on page. Required with `page`.

### Create new Order or update existing one

#### Request

`POST http://localhost:8000//api/order/`

    curl --location --request POST 'http://localhost:8000//api/order'
    --header 'Accept: application/json' 

#### Response

    {
        "data": {
            "id": 11,
            "status": null,
            "updated_at": "2022-11-05T14:42:42.000000Z",
            "dishes": [],
            "total": 0
        }
    }


#### Optional Parameters

These parameters are not required, but are possible to add:

1. `id` - request will update order with given ID instead of creating new one.
2. `status` - status of the order. `opened` - the order is opened to modification, `closed` - the order is not allowed to edit.
3. `dishes` - array of dishes that will be attached to the order.
    1. `dishes[*][id]` - ID of the dish.
   2. `dishes[*][amount]` - amount of the dish attached to the order.

### Get specific Order

#### Request

`GET http://localhost:8000//api/order/{{id}}`

    curl --location --request GET 'http://localhost:8000//api/order/1' 
    --header 'Accept: application/json' 

#### Response

    {
        "data": {
            "id": 1,
            "status": "opened",
            "updated_at": "2022-11-05T14:31:27.000000Z",
            "dishes": [
                {
                    "id": 6,
                    "name": "hic",
                    "price": 804.75,
                    "amount": 7
                }
            ],
            "total": 5633.25
        }
    }

### Delete specific Order

#### Request

`DELETE http://localhost:8000//api/order/{{id}}`

    curl --location --request DELETE 'http://localhost:8000//api/order/1' 
    --header 'Accept: application/json' 

#### Response

    {
        "data": null
    }

