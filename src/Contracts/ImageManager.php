<?php namespace Nord\Lumen\ImageManager\Contracts;

use Nord\Lumen\FileManager\Contracts\File;
use Nord\Lumen\ImageManager\Exceptions\AdapterException;
use Nord\Lumen\ImageManager\Exceptions\StorageException;
use Symfony\Component\HttpFoundation\File\File as FileInfo;

interface ImageManager
{

    /**
     * @param File  $file
     * @param array $options
     *
     * @return string
     */
    public function getImageUrl(File $file, array $options = []);
}
