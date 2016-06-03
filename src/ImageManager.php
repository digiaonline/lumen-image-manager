<?php namespace Nord\Lumen\ImageManager;

use Nord\Lumen\FileManager\Contracts\File;
use Nord\Lumen\FileManager\Contracts\FileManager;
use Nord\Lumen\ImageManager\Contracts\ManipulatorAdapter;
use Nord\Lumen\ImageManager\Contracts\ImageManager as ImageManagerContract;
use Nord\Lumen\ImageManager\Exceptions\AdapterException;

class ImageManager implements ImageManagerContract
{
    const MANIPULATOR_CLOUDINARY = 'cloudinary';
    const DEFAULT_MANIPULATOR    = self::MANIPULATOR_CLOUDINARY;

    /**
     * @var FileManager
     */
    private $fileManager;

    /**
     * @var ManipulatorAdapter[]
     */
    private $adapters = [];


    /**
     * ImageManager constructor.
     *
     * @param FileManager $fileManager
     */
    public function __construct(FileManager $fileManager)
    {
        $this->fileManager = $fileManager;
    }


    /**
     * @inheritdoc
     */
    public function getImageUrl(File $file, array $options = [])
    {
        $path = $this->fileManager->getFilePath($file, $options);

        $manipulator = array_pull($options, 'manipulator', self::DEFAULT_MANIPULATOR);

        return $this->getManipulator($manipulator)->getImageUrl($path, $options);
    }


    /**
     * @param ManipulatorAdapter $manipulator
     */
    public function addAdapter(ManipulatorAdapter $manipulator)
    {
        $this->adapters[$manipulator->getName()] = $manipulator;
    }


    /**
     * @param string $name
     *
     * @return ManipulatorAdapter
     * @throws AdapterException
     */
    protected function getManipulator($name)
    {
        if (!isset($this->adapters[$name])) {
            throw new AdapterException("Adapter for manipulator '$name' not found.");
        }

        return $this->adapters[$name];
    }
}
