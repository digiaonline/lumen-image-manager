# lumen-image-manager

Image manager for the Lumen PHP framework.

**Please note that this module is still under active development.**

## Requirements

- PHP 5.5.9 or newer
- [Composer](http://getcomposer.org)

## Usage

### Installation

Run the following command to install the package through Composer:

```sh
composer require nordsoftware/lumen-image-manager
```

### Bootstrapping

**Please note that we only support Doctrine for now, but we plan to add Eloquent support soon.**

Add the following lines to ```bootstrap/app.php```:

```php
$app->register('Nord\Lumen\Cloudinary\CloudinaryServiceProvider');
```

```php
$app->register('Nord\Lumen\ImageManager\Doctrine\DoctrineServiceProvider');
$app->register('Nord\Lumen\ImageManager\FileManagerServiceProvider');
```

You can now use the ```ImageManager``` facade or inject the ```Nord\Lumen\ImageManager\Contracts\ImageManager``` where needed.

### Example

Below is an example of how to use this module to save an image from the request
and return a JSON response with the saved image's ID and URLs.

```php
public function uploadImage(Request $request, ImageManager $imageManager)
{
    // Save the image directly to Cloudinary
    $image = $imageManager->saveImage($request->file('upload'), 'avatar', ['disk' => 'cloudinary']);

    return Response::json([
        'id'  => $image->getFileId(),
        'url' => $imageManager->getImageUrl($image),
        'variations' => [
            'small'  => $imageManager->getImageUrl($image, ['transformation' => 'small']),
            'medium' => $imageManager->getImageUrl($image, ['transformation' => 'medium']),
            'large'  => $imageManager->getImageUrl($image, ['transformation' => 'large']),
        ]
    ]);
}
```

## Contributing

Please note the following guidelines before submitting pull requests:

- Use the [PSR-2 coding style](https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-2-coding-style-guide.md)
- Create pull requests for the *develop* branch

## License

See [LICENSE](LICENSE).
