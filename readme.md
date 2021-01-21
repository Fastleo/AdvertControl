# AdvertControl

## Installation

```
composer require fastleo/advertcontrol
```

###Сбор данных
```
use Fastleo\AdvertControl\AdvertControl;
AdvertControl::set($user_id)
```

###Отправка данных
```
use Fastleo\AdvertControl\AdvertControl;
Fastleo\AdvertControl\AdvertControl::send($_POST)
```
