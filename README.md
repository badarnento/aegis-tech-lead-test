# Aegis-tech-lead-test
This repository is for Aegis Labs testing and contains Laravel code with a basic RESTful API.

This is a simple application built with **Laravel 10**. It provides an API for user and order management, with features such as creating users, managing orders, and sending registration confirmation emails.

## Requirements

Before you begin, ensure that your local development environment meets the following requirements:

- PHP 8.1 or higher
- Composer
- Laravel 10
- MySQL or another supported database
- Postman (for API testing)

## Setup

After you clone to your local, follow these steps to run the application locally:

### 1. Run Composer Install

```
composer install

php artisan key:generate
```

### 2. Configure your Database

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_database_username
DB_PASSWORD=your_database_password
```

### 3. Configure Mail Server

```
MAIL_MAILER=smtp
MAIL_HOST=localhost
MAIL_PORT=25
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS="hello@example.com"
MAIL_FROM_NAME="${APP_NAME}"
```

### 4. Configure Queue Connection

```
QUEUE_CONNECTION=database
```

### 5. Run Migration

```
php artisan migrate
```

### 6. Run Seeder

```
php artisan db:seed --class=UserSeeder
php artisan db:seed --class=OrderSeeder
```

### 7. Run the Application Locally

```
php artisan serve
```


## Postman Collection
To test the API, you can download the Postman collection below:

[Download Postman Collection](https://shorturl.at/N7ZAO)


Import the collection into Postman to test the various endpoints for creating users, orders, and confirming registrations.


### You can use my env config from .env.development