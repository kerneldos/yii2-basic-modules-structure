<?php


namespace app\components;


use yii\base\Application;
use yii\base\BootstrapInterface;
use yii\base\Module;

class BaseModule extends Module implements BootstrapInterface
{
    const EVENT_USER_AFTER_LOGIN = 'userAfterLogin';
    const EVENT_USER_AFTER_SIGNUP = 'userAfterSignup';

    /**
     * @param string $id name
     * @param Module $parent
     * @param array $config
    */
    public function __construct($id, $parent = null, $config = [])
    {
        $arch = ($parent->getUniqueId() == 'admin') ? 'backend' : 'frontend';

        $config = [
            "controllerNamespace" => "app\\modules\\$id\\controllers\\$arch",
            "viewPath" => "@app/modules/$id/views/$arch",
        ];

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

    public static function getEventHandlers() {
        return [];
    }
}