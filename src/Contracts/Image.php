<?php

namespace Nord\Lumen\ImageManager\Contracts;

use Nord\Lumen\FileManager\Contracts\File;

interface Image
{

    /**
     * @return File
     */
    public function getFile();

    /**
     * @param array $options
     *
     * @return string
     */
    public function getUrl(array $options = []);
}
