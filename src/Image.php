<?php

namespace Nord\Lumen\ImageManager;

use Nord\Lumen\FileManager\Contracts\File;
use Nord\Lumen\ImageManager\Contracts\Image as ImageContract;
use Nord\Lumen\ImageManager\Facades\ImageManager;

class Image implements ImageContract
{

    /**
     * @var File
     */
    private $file;


    /**
     * Image constructor.
     *
     * @param File $file
     */
    public function __construct(File $file)
    {
        $this->file = $file;
    }


    /**
     * @inheritdoc
     */
    public function getFile()
    {
        return $this->file;
    }


    /**
     * @inheritdoc
     */
    public function getUrl(array $options = [])
    {
        return ImageManager::getImageUrl($this->getFile(), $options);
    }
}
