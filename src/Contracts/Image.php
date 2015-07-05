<?php namespace Nord\Lumen\ImageManager\Contracts;

use Nord\Lumen\FileManager\Contracts\File;

interface Image
{

    const RENDERER_CLOUDINARY = 'cloudinary';


    /**
     * @return File
     */
    public function getFile();


    /**
     * @return string
     */
    public function getRenderer();


    /**
     * @return string
     */
    public function getFileId();


    /**
     * @return string
     */
    public function getFilePath();
}
