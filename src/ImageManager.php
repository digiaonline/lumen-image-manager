<?php namespace Nord\Lumen\ImageManager;

use Nord\Lumen\FileManager\Contracts\File;
use Nord\Lumen\FileManager\Contracts\FileManager;
use Nord\Lumen\ImageManager\Contracts\RendererAdapter;
use Nord\Lumen\ImageManager\Contracts\Image as ImageContract;
use Nord\Lumen\ImageManager\Contracts\ImageManager as ImageManagerContract;
use Nord\Lumen\ImageManager\Contracts\ImageStorage;
use Nord\Lumen\ImageManager\Exceptions\AdapterException;
use Nord\Lumen\ImageManager\Exceptions\StorageException;
use Symfony\Component\HttpFoundation\File\File as FileInfo;

class ImageManager implements ImageManagerContract
{

    /**
     * @var FileManager
     */
    private $fileManager;

    /**
     * @var ImageStorage
     */
    private $storage;

    /**
     * @var RendererAdapter[]
     */
    private $adapters = [];


    /**
     * ImageManager constructor.
     *
     * @param FileManager  $fileManager
     * @param ImageStorage $storage
     */
    public function __construct(FileManager $fileManager, ImageStorage $storage)
    {
        $this->fileManager = $fileManager;
        $this->storage     = $storage;
    }


    /**
     * @inheritdoc
     */
    public function saveImage(FileInfo $info, $name, array $options = [])
    {
        $file = $this->fileManager->saveFile($info, $name, $options);

        /** @var ImageContract $image */
        $image = app()->make(ImageContract::class);

        $image->setFile($file);
        $image->setRenderer(array_pull($options, 'renderer', ImageContract::RENDERER_CLOUDINARY));

        if (!$this->storage->saveImage($image)) {
            throw new StorageException("Failed to insert image into database.");
        }

        return $image;
    }


    /**
     * @inheritdoc
     */
    public function getImage(File $file)
    {
        return $this->storage->getImage($file);
    }


    /**
     * @inheritdoc
     */
    public function getImageUrl(ImageContract $image, array $options = [])
    {
        return $this->fileManager->getFileUrl($image->getFile(), $options);
    }


    /**
     * @inheritdoc
     */
    public function renderImage(ImageContract $image, array $options = [])
    {
        return $this->getAdapter($image->getRenderer())->renderImage($image, $options);
    }


    /**
     * @inheritdoc
     */
    public function deleteImage(ImageContract $image, array $options = [])
    {
        $this->fileManager->deleteFile($image->getFile());

        if (!$this->storage->deleteImage($image)) {
            throw new StorageException("Failed to delete file from database.");
        }
    }


    /**
     * @param RendererAdapter $adapter
     */
    public function addAdapter(RendererAdapter $adapter)
    {
        $this->adapters[$adapter->getName()] = $adapter;
    }


    /**
     * @param string $name
     *
     * @return RendererAdapter
     * @throws AdapterException
     */
    protected function getAdapter($name)
    {
        if (!isset($this->adapters[$name])) {
            throw new AdapterException("Adapter for renderer '$name' not found.");
        }

        return $this->adapters[$name];
    }
}
