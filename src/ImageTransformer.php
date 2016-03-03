<?php

namespace Nord\Lumen\ImageManager;

use League\Fractal\TransformerAbstract;
use Nord\Lumen\FileManager\FileTransformer;
use Nord\Lumen\ImageManager\Contracts\Image as ImageContract;

class ImageTransformer extends TransformerAbstract
{

    /**
     * List of resources possible to include
     *
     * @var array
     */
    protected $availableIncludes = [
        'file',
    ];


    /**
     * @param string        $url
     * @param ImageContract $image
     *
     * @return array
     */
    public function transform(ImageContract $image)
    {
        return [
            'url' => $image->getUrl(),
        ];
    }


    /**
     * @param ImageContract $image
     *
     * @return \League\Fractal\Resource\Item
     */
    public function includeFile(ImageContract $image)
    {
        return $this->item($image->getFile(), new FileTransformer);
    }
}
