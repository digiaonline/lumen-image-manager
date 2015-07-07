<?php namespace Nord\Lumen\ImageManager\Adapters\Cloudinary;

use Cloudinary;
use Nord\Lumen\FileManager\Contracts\File;
use Nord\Lumen\ImageManager\Contracts\Image;
use Nord\Lumen\ImageManager\Contracts\ManipulatorAdapter;

class CloudinaryAdapter implements ManipulatorAdapter
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
    public function getImageUrl($path, array $options)
    {
        return cloudinary_url($path, $options);
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
