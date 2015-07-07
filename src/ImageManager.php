<?php namespace Nord\Lumen\ImageManager;

use Nord\Lumen\FileManager\Contracts\File;
use Nord\Lumen\FileManager\Contracts\FileManager;
use Nord\Lumen\ImageManager\Contracts\ManipulatorAdapter;
use Nord\Lumen\ImageManager\Contracts\ImageManager as ImageManagerContract;
use Nord\Lumen\ImageManager\Exceptions\AdapterException;
use Symfony\Component\HttpFoundation\File\File as FileInfo;

class ImageManager implements ImageManagerContract
{

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

        return $this->getManipulator($file->getDisk())->getImageUrl($path, $options);
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
