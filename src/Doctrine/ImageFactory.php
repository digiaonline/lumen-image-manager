<?php namespace Nord\Lumen\ImageManager\Doctrine;

use Nord\Lumen\FileManager\Contracts\File;
use Nord\Lumen\ImageManager\Contracts\ImageFactory as ImageFactoryContract;

class ImageFactory implements ImageFactoryContract
{

    /**
     * @inheritdoc
     */
    public function createImage(File $file, $renderer)
    {
        return new Image($file, $renderer);
    }
}
