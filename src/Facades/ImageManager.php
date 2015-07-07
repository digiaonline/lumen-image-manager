<?php namespace Nord\Lumen\ImageManager\Facades;

use Illuminate\Support\Facades\Facade;

class ImageManager extends Facade
{

    /**
     * @inheritdoc
     */
    protected static function getFacadeAccessor()
    {
        return 'Nord\Lumen\ImageManager\Contracts\ImageManager';
    }
}
