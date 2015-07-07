# lumen-image-manager

[![Latest Stable Version](https://poser.pugx.org/nordsoftware/lumen-image-manager/version)](https://packagist.org/packages/nordsoftware/lumen-image-manager)
[![Total Downloads](https://poser.pugx.org/nordsoftware/lumen-image-manager/downloads)](https://packagist.org/packages/nordsoftware/lumen-image-manager)
[![License](https://poser.pugx.org/nordsoftware/lumen-image-manager/license)](https://packagist.org/packages/nordsoftware/lumen-image-manager)

Image manager for the Lumen PHP framework.

**Please note that this module is still under active development.**

## Requirements

- PHP 5.5.9 or newer
- [Composer](http://getcomposer.org)
- [FileManager](http://github.com/nordsoftware/lumen-file-manager)

## Usage

### Installation

Run the following command to install the package through Composer:

```sh
composer require nordsoftware/lumen-image-manager
```

### Bootstrapping

**Please note that we only support Cloudinary for now.**

Add the following lines to ```bootstrap/app.php```:

```php
$app->register('Nord\Lumen\Cloudinary\CloudinaryServiceProvider');
```

```php
$app->register('Nord\Lumen\ImageManager\ImageManagerServiceProvider');
```

You can now use the ```ImageManager``` facade or inject the ```Nord\Lumen\ImageManager\Contracts\ImageManager``` where needed.

### Example

Below is an example of how to use this module to save an image from the request
and return a JSON response with the saved image's ID and URLs.

```php
public function uploadImage(Request $request, FileManager $fileManager, ImageManager $imageManager)
{
    // Save the image directly to Cloudinary
    $file = $fileManager->saveFile($request->file('upload'), ['disk' => 'cloudinary']);

    return Response::json([
        'id'  => $file->getId(),
        'url' => $imageManager->getImageUrl($file, ['transformation' => 'small'])
    ]);
}
```

## Contributing

Please note the following guidelines before submitting pull requests:

- Use the [PSR-2 coding style](https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-2-coding-style-guide.md)
- Create pull requests for the *develop* branch

## License

See [LICENSE](LICENSE).
