<?php namespace Nord\Lumen\ImageManager\Doctrine;

use Nord\Lumen\FileManager\Contracts\File;
use Nord\Lumen\ImageManager\Contracts\ImageFactory as ImageFactoryContract;
use Nord\Lumen\ImageManager\Contracts\ImageManager;

class ImageFactory implements ImageFactoryContract
{

    /**
     * @inheritdoc
     */
    public function createImage(ImageManager $manager, File $file, $renderer)
    {
        return new Image($manager, $file, $renderer);
    }
}
