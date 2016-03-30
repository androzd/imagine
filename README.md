# Laravel Imagine

This library provides easy way to generate image previews on the fly


## Installation

First, require the package using Composer:
```shell
composer require androzd/imagine
```

Now, add these service providers to your `config/app.php` file (don't add the `Intervention\Image\ImageServiceProvider::class` if you already have it).

```php
Intervention\Image\ImageServiceProvider::class,
Androzd\Imagine\ImagineServiceProvider::class,
```

And finally add these to the aliases array (note: Image must be listed before Imagine):

```php
'Image'   => Intervention\Image\Facades\Image::class,
'Imagine' => Androzd\Imagine\ImagineFacade::class,
```

Feel free to use a different alias for `Imagine` if you'd prefer something shorter

## Configuration

There are a number of configuration options available for Imagine. Run the following Artisan command to publish the configuration option to your `config` directory:

```shell
php artisan vendor:publish --provider="Androzd\Imagine\ImagineServiceProvider"
```

## Usage

```php

// compress image by rules
Imagine::path('rule_name', 'path to image in public directory');
```

Example:
```php
Imagine::path('profile_image', '/uploads/original/avatar/1.jpg');
```

This example makes path: /cache/profile_image/uploads/original/avatar/1.jpg

If this image exists, it was returned by your web server as static resource.

If not exists, they will be generated and saved to /cache/profile_image/uploads/original/avatar/1.jpg
and next time will be returned as static image. 