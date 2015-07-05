<?php namespace Nord\Lumen\ImageManager\Doctrine;

use Nord\Lumen\Doctrine\Traits\AutoIncrements;
use Nord\Lumen\FileManager\Contracts\File;
use Nord\Lumen\ImageManager\Contracts\Image as ImageContract;

class Image implements ImageContract
{

    use AutoIncrements;

    /**
     * @var File
     */
    private $file;

    /**
     * @var string
     */
    private $renderer;


    /**
     * @inheritdoc
     */
    public function getFileId()
    {
        return $this->file->getId();
    }


    /**
     * @inheritdoc
     */
    public function getFilename()
    {
        return $this->file->getFilename();
    }


    /**
     * @inheritdoc
     */
    public function getFilePath()
    {
        return $this->file->getFilePath();
    }


    /**
     * @inheritdoc
     */
    public function getFile()
    {
        return $this->file;
    }


    /**
     * @inheritdoc
     */
    public function getRenderer()
    {
        return $this->renderer;
    }


    /**
     * @inheritdoc
     */
    public function setFile(File $file)
    {
        $this->file = $file;
    }


    /**
     * @inheritdoc
     */
    public function setRenderer($renderer)
    {
        if (empty($renderer)) {
            throw new \Exception('Image renderer cannot be empty.');
        }

        $this->renderer = $renderer;
    }
}
