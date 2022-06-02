# Commerce Laravel app


For start, you should have installed composer, docker, php 8 and laravel 9.

Clone project on your device.

```php
git clone https://github.com/simpxplay/commerce.git
```

Commands to start:

```php
cd commerce/
cp .env.example .env

docker-compose up -d --build
docker exec --user "$(id -u):$(id -g)" -it app_q bash

composer install
php artisan key:generate
```

Next fill up `.env` file with your credentials

```php
php artisan migrate --seed
```

That's it, you have access to endpoints via `http://localhost:8400/`
