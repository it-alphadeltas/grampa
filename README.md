# Grampa

This package extends ohmybrew package and provides you an opportunity to make grandfather shopify app installations.

## Installation

* Add vcs repository to your composer.json
    ```json
    "repositories": [
        {
            "type": "vcs",
            "url": "https://github.com/it-alphadeltas/grampa.git"
        }
    ],
    ```
* Install package with composer
    ``` bash
    $ composer require alphadeltas/grampa
    ```

## Usage

GrampaServiceProvider will be automatically added to laravel providers by composer.

Optionally you can enable it manually in your config/app.php file. 
Add this line to providers array: 

```php
'providers' => [
    AlphaDeltas\Grampa\GrampaServiceProvider::class,
],
```

You can also publish config with the following command:

``` bash
php artisan vendor:publish --provider="AlphaDeltas\Grampa\GrampaServiceProvider" --tag=config
```

Then you can use `/login-admin` route of your app which will set your shop as grandfathered after the app installation. You can also set basic http auth on this route using `grampa` config file. 
