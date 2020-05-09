<?php

namespace app\modules\site;


use app\components\BaseModule;
use app\modules\site\components\EventHandler;
use yii\helpers\ArrayHelper;
use yii\web\Application;

/**
 * site module definition class
 */
class Module extends BaseModule
{
    /**
     * Bootstrap method to be called during application bootstrap stage.
     * @param Application $app the application currently running
     */
    public function bootstrap($app)
    {
        // TODO: Implement bootstrap() method.
    }

    public static function getEventHandlers()
    {
        return ArrayHelper::merge(parent::getEventHandlers(), [
            BaseModule::EVENT_USER_AFTER_LOGIN => [
                [EventHandler::class , 'userAfterLogin'],
            ],
        ]);
    }
}
