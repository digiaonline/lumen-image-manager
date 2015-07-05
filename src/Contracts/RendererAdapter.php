<?php namespace Nord\Lumen\ImageManager\Contracts;

interface RendererAdapter
{

    /**
     * @return string
     */
    public function getName();


    /**
     * @param Image $image
     * @param array $options
     *
     * @return string
     */
    public function renderImage(Image $image, array $options);


    /**
     * @param Image $image
     * @param array $options
     *
     * @return string
     */
    public function getImageUrl(Image $image, array $options);
}
