Check out on Behance: https://www.behance.net/gallery/174706055/Mova-frontend-backend

![alt text](https://mir-s3-cdn-cf.behance.net/project_modules/fs/a7ef90174706055.64a6e541d0cca.jpg)

# Mova::Laravel

Deploy Mova application

## Installation

Configure .env file to define database connection - Change APP_ENV=production to APP_ENV=dev . After migration, set this value to production

Run composer to install dependencies
```shell
composer install
```

Clean application cache
```shell
php artisan config:cache
```

And then execute migrations:

```shell
php artisan migrate
```

Important: populate table 'precos' with precos.sql

Set document root like this: '/var/www/html/public' (you need to consult the directory structure of apache2);
