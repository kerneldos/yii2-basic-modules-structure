<?php


namespace app\components;


use yii\base\Application;
use yii\base\BootstrapInterface;
use yii\base\Module;

class BaseModule extends Module implements BootstrapInterface {
    const EVENT_USER_AFTER_LOGIN = 'userAfterLogin';
    const EVENT_USER_AFTER_SIGNUP = 'userAfterSignup';

    /**
     * Bootstrap method to be called during application bootstrap stage.
     * @param Application $app the application currently running
     */
    public function bootstrap($app) {
        // TODO: Implement bootstrap() method.
    }

    public static function getEventHandlers() {
        return [];
    }
}