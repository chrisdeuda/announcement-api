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
5. Insert Sample test admin user by:
    1. Go to folder `sql`.
    2. There should be file sample-user.sql 
    3. Import the query in your MySQl Editor
    

## Running the lumen application
Run this command to run the lumen application:
```
php -S localhost:8000 -t public
```

## Running Unit Test/ Testing
**No Unit Test** I was get stuck with disabling middleware when writing test and don't have enough time.

```
