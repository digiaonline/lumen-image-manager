<?php namespace Nord\Lumen\ImageManager;

use Illuminate\Contracts\Config\Repository as ConfigRepository;
use Illuminate\Contracts\Container\Container;
use Illuminate\Support\ServiceProvider;
use Nord\Lumen\FileManager\Contracts\FileManager;
use Nord\Lumen\ImageManager\Contracts\ImageManager as ImageManagerContract;
use Nord\Lumen\ImageManager\Contracts\ImageStorage as ImageStorageContract;
use Nord\Lumen\ImageManager\Facades\ImageManager as ImageManagerFacade;
use Nord\Lumen\ImageManager\Adapters\Cloudinary\CloudinaryAdapter;

class ImageManagerServiceProvider extends ServiceProvider
{

    private static $defaultAdapters = [
        ['class' => CloudinaryAdapter::class],
    ];


    /**
     * @inheritdoc
     */
    public function register()
    {
        $this->registerContainerBindings($this->app, $this->app['config']);
        $this->registerFacades();
    }


    /**
     * @param Container        $container
     * @param ConfigRepository $config
     */
    protected function registerContainerBindings(Container $container, ConfigRepository $config)
    {
        $container->alias(ImageManager::class, ImageManagerContract::class);

        $container->singleton(ImageManagerContract::class, function () use ($container, $config) {
            return $this->createManager($container, $config);
        });
    }


    /**
     *
     */
    protected function registerFacades()
    {
        class_alias(ImageManagerFacade::class, 'ImageManager');
    }


    /**
     * @param Container        $container
     * @param ConfigRepository $config
     */
    protected function createManager(Container $container, ConfigRepository $config)
    {
        $fileManager = $container->make(FileManager::class);
        $storage     = $container->make(ImageStorageContract::class);

        $imageManager = new ImageManager($fileManager, $storage);

        $this->configureManager($imageManager, $container, $config->get('imagemanager', []));

        return $imageManager;
    }


    /**
     * @param ImageManager $imageManager
     * @param Container    $container
     * @param array        $config
     */
    protected function configureManager(ImageManager $imageManager, Container $container, array $config)
    {
        $adapterConfigs = array_merge(array_get($config, 'adapters', []), self::$defaultAdapters);

        foreach ($adapterConfigs as $adapterConfig) {
            $className = array_pull($adapterConfig, 'class');

            $adapter = $container->make($className, ['config' => $adapterConfig]);

            $imageManager->addAdapter($adapter);
        }
    }
}
