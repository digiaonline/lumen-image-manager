<?php namespace Nord\Lumen\ImageManager\Doctrine;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Nord\Lumen\FileManager\Contracts\File;
use Nord\Lumen\ImageManager\Contracts\Image as ImageContract;
use Nord\Lumen\ImageManager\Contracts\ImageStorage as ImageStorageContract;

class ImageStorage implements ImageStorageContract
{

    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * @var EntityRepository
     */
    private $repository;


    /**
     * FileStorage constructor.
     *
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;

        $this->repository = $this->entityManager->getRepository(Image::class);
    }


    /**
     * @inheritdoc
     */
    public function saveImage(ImageContract $image)
    {
        $this->entityManager->persist($image);
        $this->entityManager->flush();

        return true;
    }


    /**
     * @inheritdoc
     */
    public function getImage(File $file)
    {
        return $this->repository->findOneBy(['file' => $file]);
    }


    /**
     * @inheritdoc
     */
    public function deleteImage(ImageContract $image)
    {
        $this->entityManager->remove($image);
        $this->entityManager->flush();

        return true;
    }
}
