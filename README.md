![banner](https://banners.beyondco.de/Laravel%20Route%20Debug.png?theme=dark&packageManager=composer+require&packageName=lukasss93%2Flaravel-route-debug+--dev&pattern=brickWall&style=style_1&description=A+simple+package+that+prints+the+current+route+name+and+action+in+the+Response+Headers.&md=1&showWatermark=0&fontSize=100px&images=fast-forward)


# Laravel Route Debug

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

Config content:

```php
return [
    'enabled' => env('APP_DEBUG', false),
];
```

## 👓 Usage
Enable the package turning on the `APP_DEBUG` environment variable or by setting the `enabled` config option to `true`.

Then, when you visit a page, you will see the route name and action in the response headers.

### Screenshot
![preview](https://i.imgur.com/78vaDXi.png)


## ⚗️ Testing

```bash
composer test
```

## 🔰 Version Support

| Package | L8.x | L9.x | L10.x |
|:-------:|:----:|:----:|:-----:|
|  ^1.0   |  ✅   |  ✅   |   ✅   |

| Package | P7.4 | P8.0 | P8.1 | P8.2 |
|:-------:|:----:|:----:|:----:|:----:|
|  ^1.0   |  ✅   |  ✅   |  ✅   |  ✅   |


## 📃 Changelog

Please see the [CHANGELOG.md](CHANGELOG.md) for more information
on what has changed recently.

## 🏅 Credits

- [Luca Patera](https://github.com/Lukasss93)
- [All Contributors](https://github.com/Lukasss93/laravel-route-debug/contributors)

## 📖 License

Please see the [LICENSE.md](LICENSE.md) file for more
information.
