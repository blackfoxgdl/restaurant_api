Please, run using php artisan serve.

#API

USERS: 
    - SHOW ALL: HOST/api/users
    - SHOW: HOST/api/users/id
    - CREATE: HOST/api/users
        {
            "name": "Nombre USER",
            "email": "example@example.com"
        }

PRODUCTS:
    - SHOW ALL: HOST/api/products
    - SHOW: HOST/api/products/id
    - CREATE: HOST/api/products
        {
            "name": "Hot Dogs",
            "price": "75.00",
            "amount": "0"
        }

ORDERS:
    - CREATE: HOST/api/orders
        {
           "name": "Ruben Alonso",
            "products": [
                "Hot Dogs",
                "Hot Dogs",
                "Hamburguesa"
            ]
        }
    - SHOW ALL: /api/orders
    - SHOW: /api/orders/{id}

REPORTS:
    - HOST/api/reports/2021-01-01/2021-07-30
