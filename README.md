# File Handler

[![Packagist](https://img.shields.io/packagist/v/yasinkose/file-handler.svg)](https://packagist.org/packages/yasinkose/file-handler)
[![Packagist](https://poser.pugx.org/yasinkose/file-handler/d/total.svg)](https://packagist.org/packages/yasinkose/file-handler)
[![Packagist](https://img.shields.io/packagist/l/yasinkose/file-handler.svg)](https://packagist.org/packages/yasinkose/file-handler)

# Description

You can send your files to remote server
application ([YasinKose/lumen-file-storage-service](https://github.com/YasinKose/lumen-file-storage-service)) using this
repository.

## Installation

Install via composer

```bash
composer require yasinkose/file-handler
```

## Publish package assets

```bash
php artisan vendor:publish --provider="YasinKose\FileHandler\ServiceProvider"
```

## Usage

Here's how you can send files:

```php
FileHandler::sendFile($request->allFiles());
```

OR

```php
FileHandler::addFile($request->allFiles())->sendFile();
```

Here's the response you'll get

```array
Array
(
    [0] => stdClass Object
        (
            [original_name] => screenshot_1.png
            [slug] => lHVRttkrqM
            [url] => https://***.com/file/lHVRttkrqM
        )

    [1] => stdClass Object
        (
            [original_name] => screenshot_2.png
            [slug] => kC8Svz0njs
            [url] => https://***.com/file/kC8Svz0njs
        )
)
```

## Security

If you discover any security related issues, please email instead of using the issue tracker.

## Contributors ✨

Thanks goes to these people:

- [Yasin Köse](https://github.com/yasinkose/file-handler)
- [All contributors](https://github.com/yasinkose/file-handler/graphs/contributors)
