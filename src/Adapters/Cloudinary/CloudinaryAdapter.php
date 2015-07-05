<?php namespace Nord\Lumen\ImageManager\Adapters\Cloudinary;

use Cloudinary;
use Nord\Lumen\ImageManager\Contracts\Image;
use Nord\Lumen\ImageManager\Contracts\RendererAdapter;

class CloudinaryAdapter implements RendererAdapter
{

    /**
     * CloudinaryAdapter constructor.
     *
     * @param array $config
     */
    public function __construct(array $config)
    {
        $this->configureClient($config);
    }


    /**
     * @return string
     */
    public function getName()
    {
        return 'cloudinary';
    }


    /**
     * @inheritdoc
     */
    public function getImageUrl(Image $image, array $options)
    {
        return cloudinary_url($image->getFilePath(), $options);
    }


    /**
     * @inheritdoc
     */
    public function renderImage(Image $image, array $options)
    {
        return cl_image_tag($image->getFilePath(), $options);
    }


    /**
     * @param array $config
     */
    private function configureClient(array $config)
    {
        $cloudName = array_get($config, 'cloudName', env('CLOUDINARY_NAME'));
        $apiKey    = array_get($config, 'apiKey', env('CLOUDINARY_KEY'));
        $apiSecret = array_get($config, 'apiSecret', env('CLOUDINARY_SECRET'));

        Cloudinary::config([
            'cloud_name' => $cloudName,
            'api_key'    => $apiKey,
            'api_secret' => $apiSecret,
        ]);
    }
}
