

# Accessing the API

## Base URL

All API endpoints are accessible via the base URL:

```shell
http://localhost:8000/api
```

## Authentication

### Register

Send a `POST` request to `/register` with the User information (`first_name`, `last_name`, ...etc).

The response will include an API token. Use this token for authenticated requests.

Response example:

```json
{
  "success": true,
  "data": {
    "token": "1|tFtY9eUw1r2WIgc75vxVUjIeWfdBOlsD7GtMdPo674854f95",
    "first_name": "Ahmad",
    "last_name": "Alkaf"
  },
  "message": "User registered successfully."
}
```

### Login

Send a `POST` request to `/login` with `email` and `password` parameters.

Response example:
```json
{
  "success": true,
  "data": {
    "token": "2|5zb8PifdsJCTBBgyAgIdujbJK1fbYP0fW8FYZlDe3789cc4b",
    "first_name": "Test",
    "last_name": "User"
  },
  "message": "User logged in successfully."
}
```

### Making Requests

Use tools like <b>Postman</b> or <b>Thunder Client</b> to interact with the API.

Include the following header in your requests:

```shell
Authorization: Bearer YOUR_API_TOKEN
```

## Setup Development Environment

Clone the repo to your local computer:
```shell
git clone https://github.com/Ahmad-Alkaf/Task2-Laravel
```

Navigate to the cloned project folder:
```shell
cd Task2-Laravel
```

Install the dependencies:
```shell
composer install
```

Create `.env` file:
```shell
cp .env.expample .env
```

Configure the database information in the `.env` file: 
```js
DB_DATABASE=your_database_name
DB_USERNAME=your_username
DB_PASSWORD=your_password
```


Sets the `APP_KEY` value in your `.env` file:
```shell
php artisan key:generate
```

Create the `database/migrations` schema:
```shell
php artisan migrate
//OR to drop all existing tables
php artisan migrate:fresh
```

Seed the database with fake data. 
Note: there will be a user with email of `test@example.com` and password of `12345678`, you can login directly with it. 
```bash
php artisan db:seed
```

Run the app:
```shell
php artisan serve
```
