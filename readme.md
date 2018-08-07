
## Installation

composer.json

      "repositories": {
           ...
           
           "cross" : {
               "type": "composer",
               "url": "https://packagist.org"
           },
           
           ...
       }
Require the `cross/laravel-cors` package in your `composer.json` and update your dependencies:
```sh
$ composer require cross/laravel-cors dev-master
```
config/app.php

```

'providers' => [
    ...
    Cross\Cors\ServiceProvider::class,
    ...
],

'aliases' => [
    ...
    'cors' => Cross\Cors\FacadeCors::class,
    ...
]
```
App/Http/Kernel.php
```

$app->routeMiddleware([
    // ...
    'cors' => \Cross\Cors\HandleCors::class,
]);
```

## Configuration

The defaults are set in `config/cors.php`. Copy this file to your own config directory to modify the values. You can publish the config using this command:
```sh
$ php artisan vendor:publish --provider="Cross\Cors\ServiceProvider"
```
> **Note:** When using custom headers, like `X-Auth-Token` or `X-Requested-With`, you must set the `allowedHeaders` to include those headers. You can also set it to `array('*')` to allow all custom headers.

> **Note:** If you are explicitly whitelisting headers, you must include `Origin` or requests will fail to be recognized as CORS.

    
```php
return [
     /*
     |--------------------------------------------------------------------------
     | Laravel CORS
     |--------------------------------------------------------------------------
     |
     | allowedOrigins, allowedHeaders and allowedMethods can be set to array('*')
     | to accept any value.
     |
     */
    'supportsCredentials' => false,
    'allowedOrigins' => ['*'],
    'allowedHeaders' => ['Content-Type', 'X-Requested-With'],
    'allowedMethods' => ['*'], // ex: ['GET', 'POST', 'PUT',  'DELETE']
    'exposedHeaders' => [],
    'maxAge' => 0,
]
```

`allowedOrigins`, `allowedHeaders` and `allowedMethods` can be set to `array('*')` to accept any value.


## License

Released under the MIT License, see [LICENSE](LICENSE).

[link-packagist]: https://packagist.org/packages/cross/laravel-cors
[link-downloads]: https://packagist.org/packages/cross/laravel-cors
