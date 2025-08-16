<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Booking project

### installation steps

```bash
composer install
```

```bash
cp .env.example .env
```

##### \*\* handle the connection of database <br></br> then:

```php
php artisan migrate --seed

php artisan serve
```

## Download Postman collection :

[Postman collection](https://drive.google.com/file/d/1v0kFn-z5r67bt-9lFVM6uaRlIHvlUIkY/view?usp=sharing)

## for Authentication

**Admin:**

```
email:admin@project.com
password:password
```

**Provider:**

```
email:provider@project.com
password:password
```

**Customer:**

```
email:customer@project.com
password:password
```
