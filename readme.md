# AdvertControl
https://crm.g72.ru

## Installation

```
composer require fastleo/advertcontrol
```

## Used

#### Set data
```
use Fastleo\AdvertControl\AdvertControl;
AdvertControl::set($user_id)
```

#### Send data
```
use Fastleo\AdvertControl\AdvertControl;
Fastleo\AdvertControl\AdvertControl::send($_POST)
```

## Used for Laravel

#### Create middleware

```
$ php artisan make:middleware SetClientData
```

```
use Fastleo\AdvertControl\AdvertControl;

public function handle(Request $request, Closure $next)
{
    AdvertControl::set($request, $user_id);
    return $next($request);
}
```

#### Add middleware in kernel.php

```
protected $middleware = [
    ...
    \App\Http\Middleware\SetClientData::class
];
```

#### Send data
```
use Fastleo\AdvertControl\AdvertControl;
Fastleo\AdvertControl\AdvertControl::send($request)
```