# AdvertControl

## Installation

```
composer require fastleo/advertcontrol
```

## Used

#### Set data
```
use Fastleo\AdvertControl\AdvertControl;
AdvertControl::set($user_id_from_crm)
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
    AdvertControlLaravel::set($request, $user_id_from_crm);
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