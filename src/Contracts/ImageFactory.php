<?php namespace Nord\Lumen\ImageManager\Contracts;

use Nord\Lumen\FileManager\Contracts\File;

interface ImageFactory
{

    /**
     * @param File   $file
     * @param string $renderer
     *
     * @return Image
     */
    public function createImage(File $file, $renderer);
}
