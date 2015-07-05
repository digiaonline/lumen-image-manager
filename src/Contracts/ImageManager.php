<?php namespace Nord\Lumen\ImageManager\Contracts;

use Nord\Lumen\FileManager\Contracts\File;
use Nord\Lumen\ImageManager\Exceptions\AdapterException;
use Nord\Lumen\ImageManager\Exceptions\StorageException;
use Symfony\Component\HttpFoundation\File\File as FileInfo;

interface ImageManager
{

    /**
     * @param FileInfo $info
     * @param string   $name
     * @param array    $options
     *
     * @return Image
     * @throws AdapterException
     * @throws StorageException
     */
    public function saveImage(FileInfo $info, $name, array $options = []);


    /**
     * @param File $file
     *
     * @return Image
     */
    public function getImage(File $file);


    /**
     * @param Image $image
     * @param array $options
     *
     * @return string
     */
    public function getImageUrl(Image $image, array $options = []);


    /**
     * @param Image $image
     * @param array $options
     *
     * @return string
     */
    public function renderImage(Image $image, array $options = []);


    /**
     * @param Image $image
     * @param array $options
     *
     * @return bool
     * @throws AdapterException
     * @throws StorageException
     */
    public function deleteImage(Image $image, array $options = []);
}
