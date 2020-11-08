## Desafio Pocket

Este projeto consiste no desenvolvimento de dois serviços RestFull para uma API.

### Configuração de Conexão com o Banco de Dados

- Na raíz do projeto, execute o comando:
```shell script
cp .env.example .env
php artisan key:generate
```

- Configurar o ```.env```. Esses dados serão disponibilizados pelo autor do desafio por email
```dotenv
DB_CONNECTION=pgsql
DB_HOST=YOUR_HOST
DB_PORT=YOUR_PORT
DB_DATABASE=YOUR_DATABASE
DB_USERNAME=YOUR_USERNAME
DB_PASSWORD=YOUR_PASSWORD
```

#### Instalar as dependências

- Na raíz do projeto, execute o comando:

```shell script
composer install
```

#### Cadastro de Pedidos

- POST ==> http://localhost:8000/api/orders

Request Object:
```json
{
  "customer_name": "João da Silva",
  "cart": [
    {
      "qty": 1,
      "product": "Playstation 5",
      "price": 4999
    },
    {
      "qty": 1,
      "product": "Xbox Series X",
      "price": 4799.99
    },
    {
      "qty": 1,
      "product": "Xbox Series S",
      "price": 2499.99
    }
  ]
}
```
#### Consulta de Pedidos

- GET ==> http://localhost:8000/api/orders/{id}/{year}/{month}/{day}

Response Object:
```json
{
  "data": {
    "order": {
      "id": 237,
      "customer_name": "João da Silva",
      "total_order": "1099.80"
    },
    "products": [
      {
        "id": 265,
        "product": "Bola futebol",
        "price": "40.00",
        "qty": 10
      },
      {
        "id": 266,
        "product": "Chuteira Nike",
        "price": "349.90",
        "qty": 2
      }
    ]
  }
}
```
