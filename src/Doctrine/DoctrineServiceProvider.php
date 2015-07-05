<?php namespace Nord\Lumen\ImageManager\Doctrine;

use Doctrine\ORM\EntityManagerInterface;
use Illuminate\Contracts\Container\Container;
use Illuminate\Support\ServiceProvider;
use Nord\Lumen\ImageManager\Contracts\Image as ImageContract;
use Nord\Lumen\ImageManager\Contracts\ImageFactory as ImageFactoryContract;
use Nord\Lumen\ImageManager\Contracts\ImageStorage as ImageStorageContract;

class DoctrineServiceProvider extends ServiceProvider
{

    /**
     * @inheritdoc
     */
    public function register()
    {
        $this->registerContainerBindings($this->app);
    }


    /**
     *
     */
    protected function registerContainerBindings(Container $container)
    {
        $container->singleton(ImageFactoryContract::class, function () {
            return new ImageFactory();
        });

        $entityManager = $container->make(EntityManagerInterface::class);

        $container->singleton(ImageStorageContract::class, function () use ($entityManager) {
            return new ImageStorage($entityManager);
        });
    }
}
