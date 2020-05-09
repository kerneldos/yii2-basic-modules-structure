<?php


namespace app\components;

use yii\base\Application;
use yii\base\BootstrapInterface;
use yii\base\Component;

/**
 * Class EventManager
 * @package app\components
 */
class EventManager extends Component implements BootstrapInterface {

    /**
     * Bootstrap method to be called during application bootstrap stage.
     * @param Application $app the application currently running
     */
    public function bootstrap($app) {
        foreach ($app->getModules(true) as $module) {
            foreach ($module::getEventHandlers() as $event => $callbacks) {
                if (!is_array($callbacks)) {
                    $callbacks = [$callbacks];
                }
                foreach ($callbacks as $callback) {
                    \Yii::$app->on($event, $callback);
                }
            }
        }
    }
}