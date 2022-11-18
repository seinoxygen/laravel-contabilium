# Laravel Contabilium #

[![Donate](https://img.shields.io/badge/Donate-PayPal-green.svg)](https://www.paypal.com/donate/?hosted_button_id=6CYVR8U4VDMAA) ![Packagist Downloads](https://img.shields.io/packagist/dt/seinoxygen/laravel-contabilium?label=Downloads)

A Laravel wrapper for Contabilium.

## Installation

Add Laravel Contabilium as a dependency using the composer CLI:

```bash
composer require seinoxygen/laravel-contabilium
```

## Basic Usage

Add the following to your config/services.php and add the correct values to your .env file

```php
'contabilium' => [
    'client_id' => env('CONTABILIUM_CLIENT_ID'),
    'client_secret' => env('CONTABILIUM_CLIENT_SECRET'),
    'country' => env('CONTABILIUM_COUNTRY', 'ar'),
],
```

If using < Laravel 5.5, add the ContabiliumServiceProvider to the providers array

```php
'providers' => [
    ...
    SeinOxygen\Contabilium\ContabiliumServiceProvider::class,
    ...
],
```

Next, in config/app.php, add the Contabilium to the aliases array

```php
'aliases' => [
    ...
    'Contabilium' => SeinOxygen\Contabilium\Facades\Contabilium::class,
    ...
],
```

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
