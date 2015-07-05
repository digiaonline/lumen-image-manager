<?php namespace Nord\Lumen\ImageManager\Contracts;

use Nord\Lumen\FileManager\Contracts\File;

interface ImageStorage
{

    /**
     * @param Image $image
     *
     * @return bool
     */
    public function saveImage(Image $image);


    /**
     * @param File $file
     *
     * @return Image
     */
    public function getImage(File $file);


    /**
     * @param File $file
     *
     * @return bool
     */
    public function deleteImage(Image $image);
}
