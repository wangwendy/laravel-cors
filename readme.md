
## Installation

composer.json
 "repositories": {
           ...
           
          "cross" : {
            "type" : "composer",
            "url": "https://packagist.org"
        }
           
           ...
       }
Require the `cross/laravel-cors` package in your `composer.json` and update your dependencies:
```sh
$ composer require cross/laravel-cors dev-master
```

For laravel >=5.5 that's all. This package supports Laravel new [Package Discovery](https://laravel.com/docs/5.5/packages#package-discovery).

If you are using Laravel < 5.5, you also need to add Cors\ServiceProvider to your `config/app.php` providers array:
```php
Cross\Cors\ServiceProvider::class,
```

## Global usage

To allow CORS for all your routes, add the `HandleCors` middleware in the `$middleware` property of  `app/Http/Kernel.php` class:

```php
protected $middleware = [
    // ...
    \Cross\Cors\HandleCors::class,
];
```

## Group middleware

If you want to allow CORS on a specific middleware group or route, add the `HandleCors` middleware to your group:

```php
protected $middlewareGroups = [
    'web' => [
       // ...
    ],

    'api' => [
        // ...
        \Cross\Cors\HandleCors::class,
    ],
];
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

> **Note:** Try to be a specific as possible. You can start developing with loose constraints, but it's better to be as strict as possible!

> **Note:** Because of [http method overriding](http://symfony.com/doc/current/reference/configuration/framework.html#http-method-override) in Laravel, allowing POST methods will also enable the API users to perform PUT and DELETE requests as well.

### Lumen

On Laravel Lumen, load your configuration file manually in `bootstrap/app.php`:
```php
$app->configure('cors');
```

And register the ServiceProvider:

```php
$app->register(Cross\Cors\ServiceProvider::class);
```

## Global usage for Lumen
To allow CORS for all your routes, add the `HandleCors` middleware to the global middleware:
```php
$app->middleware([
    // ...
    \Cross\Cors\HandleCors::class,
]);
```

## Group middleware for Lumen
If you want to allow CORS on a specific middleware group or route, add the `HandleCors` middleware to your group:

```php
$app->routeMiddleware([
    // ...
    'cors' => \Cross\Cors\HandleCors::class,
]);
```

## Common problems and errors (Pre Laravel 5.3)
In order for the package to work, the request has to be a valid CORS request and needs to include an "Origin" header.

When an error occurs, the middleware isn't run completely. So when this happens, you won't see the actual result, but will get a CORS error instead.

This could be a CSRF token error or just a simple problem.

> **Note:** This should be working in Laravel 5.3+.

### Disabling CSRF protection for your API

If possible, use a different route group with CSRF protection enabled. 
Otherwise you can disable CSRF for certain requests in `App\Http\Middleware\VerifyCsrfToken`:

```php
protected $except = [
    'api/*'
];
```
    
## License

Released under the MIT License, see [LICENSE](LICENSE).

[link-packagist]: https://packagist.org/packages/cross/laravel-cors
[link-downloads]: https://packagist.org/packages/cross/laravel-cors
