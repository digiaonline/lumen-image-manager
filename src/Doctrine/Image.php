<?php namespace Nord\Lumen\ImageManager\Doctrine;

use Nord\Lumen\Doctrine\Traits\AutoIncrements;
use Nord\Lumen\FileManager\Contracts\File;
use Nord\Lumen\ImageManager\Contracts\Image as ImageContract;
use Nord\Lumen\ImageManager\Contracts\ImageManager;

class Image implements ImageContract
{

    use AutoIncrements;

    /**
     * @var ImageManager
     */
    private $manager;

    /**
     * @var File
     */
    private $file;

    /**
     * @var string
     */
    private $renderer;


    /**
     * Image constructor.
     *
     * @param File   $file
     * @param string $renderer
     */
    public function __construct(ImageManager $manager, File $file, $renderer)
    {
        $this->setManager($manager);
        $this->setFile($file);
        $this->setRenderer($renderer);
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
    public function getFileId()
    {
        return $this->file->getId();
    }


    /**
     * @inheritdoc
     */
    public function getFilePath(array $options = [])
    {
        return $this->manager->getImagePath($this, $options);
    }


    /**
     * @inheritdoc
     */
    public function getFileUrl(array $options = [])
    {
        return $this->manager->getImageUrl($this, $options);
    }


    /**
     * @param ImageManager $manager
     */
    private function setManager($manager)
    {
        $this->manager = $manager;
    }


    /**
     * @inheritdoc
     */
    private function setFile(File $file)
    {
        $this->file = $file;
    }


    /**
     * @inheritdoc
     */
    private function setRenderer($renderer)
    {
        if (empty($renderer)) {
            throw new \Exception('Image renderer cannot be empty.');
        }

        $this->renderer = $renderer;
    }
}
