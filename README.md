# Grampa

This package extends ohmybrew package and provides you an opportunity to make grandfather shopify app installations.

## Installation

Via Composer

``` bash
$ composer require hasfoug/grampa
```

## Usage


You need to enable GrampaServiceProvider in your config/app.php file (hopefully this will be added by composer automatically). 
Add this line to providers array: 

``` php
'providers' => [
    ...,
    Hasfoug\Grampa\GrampaServiceProvider::class,
    ...
],

```

You can also publish config with the following command:

``` bash
    php artisan vendor:publish --provider="Hasfoug\Grampa\GrampaServiceProvider" --tag=config
```

Then you can use `/login-admin` route of your app which will set your shop as grandfathered after the app installation. You can also set basic http auth on this route using `grampa` config file. 
