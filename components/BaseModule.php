<?php


namespace app\components;


use yii\base\Application;
use yii\base\BootstrapInterface;
use yii\base\Module;

class BaseModule extends Module implements BootstrapInterface
{
    /**
     * @param string $id name
     * @param Module $parent
     * @param array $config
    */
    public function __construct($id, $parent = null, $config = [])
    {
        $config = ($parent->getUniqueId() == 'admin')
            ? require $this->basePath . '/config/backend.php'
            : require $this->basePath . '/config/frontend.php';

        parent::__construct($id, $parent, $config);
    }

    /**
     * Bootstrap method to be called during application bootstrap stage.
     * @param Application $app the application currently running
     */
    public function bootstrap($app)
    {
        // TODO: Implement bootstrap() method.
    }
}