<?php namespace Nord\Lumen\ImageManager\Contracts;

interface ManipulatorAdapter
{

    /**
     * @return string
     */
    public function getName();


    /**
     * @param string $path
     * @param array  $options
     *
     * @return string
     */
    public function getImageUrl($path, array $options);
}
