![banner](https://banners.beyondco.de/Laravel%20Route%20Debug.png?theme=dark&packageManager=composer+require&packageName=lukasss93%2Flaravel-route-debug+--dev&pattern=brickWall&style=style_1&description=A+simple+package+that+prints+the+current+route+name+and+action+in+the+Response+Headers.&md=1&showWatermark=0&fontSize=100px&images=fast-forward)


# Laravel Route Debug

![Packagist](https://img.shields.io/packagist/v/lukasss93/laravel-route-debug)
![License](https://img.shields.io/packagist/l/lukasss93/laravel-route-debug)
![PHP](https://img.shields.io/packagist/dependency-v/lukasss93/laravel-route-debug/php?label=PHP&logo=php)
![Laravel](https://img.shields.io/packagist/dependency-v/lukasss93/laravel-route-debug/illuminate/support?color=orange&label=Laravel&logo=laravel)
[![run-tests](https://github.com/Lukasss93/laravel-route-debug/actions/workflows/run-tests.yml/badge.svg)](https://github.com/Lukasss93/laravel-route-debug/actions/workflows/run-tests.yml)

> A simple package that prints the current route name and action in the Response Headers.

## 🚀 Installation

You can install the package using composer

```bash
composer require lukasss93/laravel-route-debug --dev
```

Then add the service provider to `config/app.php`.  
This step *can be skipped* if package auto-discovery is enabled.

```php
'providers' => [
    Lukasss93\Laravel\RouteDebug\RouteDebugServiceProvider::class,
];
```

## ⚙ Publishing the config file

Publishing the config file is optional:

```bash
php artisan vendor:publish --provider="Lukasss93\Laravel\RouteDebug\RouteDebugServiceProvider" --tag="route-debug-config"
```

## 👓 Usage
Enable the package turning on the `APP_DEBUG` environment variable or by setting the `enabled` config option to `true`.

Then, when you visit a page, you will see the route debuggers in the response headers.

### Route Debuggers

The package will add the following headers to the response:

- `Laravel-Route-Name`: The name of the current route.
- `Laravel-Route-Action`: The action of the current route.
- `Laravel-Route-Can`: The value of the `can` middleware of the current route.
- `Laravel-Route-FormRequest`: The FormRequest class of the current route action.

You can disable any of these headers by commenting out the corresponding line in the `config/route-debug.php` file.

### Custom Route Debugger

You can create a custom route debugger to add your own headers to the response.

1. Create a new class that implements the `Lukasss93\Laravel\RouteDebug\Contracts\RouteDebugger` interface.
2. Add your custom logic to the `handle` method.
3. Register your custom route debugger in the `config/route-debug.php` file under the `debuggers` key.

### Screenshot
![preview](https://i.imgur.com/0VzNaKV.png)


## ⚗️ Testing

```bash
composer test
```

## 🔰 Version Support

| Package | L8.x | L9.x | L10.x | L11.x | L12.x | L13.x |
|:-------:|:----:|:----:|:-----:|:-----:|:-----:|:-----:|
|  ^1.0   |  ✅   |  ✅   |   ✅   |   ❌   |   ❌   |   ❌   |
|  ^2.0   |  ❌   |  ❌   |   ✅   |   ✅   |   ❌   |   ❌   |
|  ^3.0   |  ❌   |  ❌   |   ❌   |   ✅   |   ✅   |   ✅   |

| Package | PHP 7.4 | PHP 8.0 | PHP 8.1 | PHP 8.2 | PHP 8.3 | PHP 8.4 | PHP 8.5 |
|:-------:|:-------:|:-------:|:-------:|:-------:|:-------:|:-------:|:-------:|
|  ^1.0   |    ✅    |    ✅    |    ✅    |    ✅    |    ✅    |    ✅    |    ✅    |
|  ^2.0   |    ❌    |    ❌    |    ✅    |    ✅    |    ✅    |    ✅    |    ✅    |
|  ^3.0   |    ❌    |    ❌    |    ❌    |    ✅    |    ✅    |    ✅    |    ✅    |


## 📃 Changelog

Please see the [CHANGELOG.md](CHANGELOG.md) for more information
on what has changed recently.

## 🏅 Credits

- [Luca Patera](https://github.com/Lukasss93)
- [All Contributors](https://github.com/Lukasss93/laravel-route-debug/contributors)

## 📖 License

Please see the [LICENSE.md](LICENSE.md) file for more
information.
