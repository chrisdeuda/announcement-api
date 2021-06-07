# Announcement API

## Requirements

* PHP >= 7.3
* OpenSSL PHP Extension
* PDO PHP Extension
* Mbstring PHP Extension
* MySQL
* Composer

## Installation

1. Clone this project
2. Run composer command
```
    composer install
```

## Database setups
1. Copy .env configurations from `.env.example`
2. Create database new database in your Mysql Client
3. Update .env configurations base on your mysql configurations
```
DB_HOST=127.0.0.1
DB_DATABASE=your-database
DB_USERNAME=your-username
DB_PASSWORD=your-password`
```   

4. Run migrations for the default table `announcements`
```
php artisan migrate
```

## Running the lumen application
Run this command to run the lumen application:
```
php -S localhost:8000 -t public
```

## Running Customers import using terminal to import data from https://randomuser.me/api
1. Make sure that your PHP and Mysql are running.
1. Open your Terminal or CMD
2. To import customers data run:
```
    php artisan customer:import
```
_It should now import all of the data_

## Available endpoints
`localhost:8000` -  BASE URL FOR endpoints

`GET` `/customers`  - List of all customers

`GET` `/customers/{id}` - Search for specific customer

## Running Unit Test/ Testing
**No Unit Test** I was get stuck with disabling middleware when writing test and don't have enough time.

```
