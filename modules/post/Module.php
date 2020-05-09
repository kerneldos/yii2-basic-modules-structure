<?php

namespace app\modules\post;


use app\components\BaseModule;
use app\modules\post\components\EventHandler;
use yii\helpers\ArrayHelper;
use yii\web\Application;

/**
 * post module definition class
*/
class Module extends BaseModule
{
    /**
     * Bootstrap method to be called during application bootstrap stage.
     * @param Application $app the application currently running
     */
    public function bootstrap($app)
    {
        $app->getUrlManager()->addRules([
//            '<module>/<_a:view>/<id>' => '<module>/default/<_a>',
        ], false);
    }

    /**
     * Initializes the module.
     */
    public function init()
    {
        parent::init();

        // custom initialization code goes here
    }

    public static function getEventHandlers()
    {
        return ArrayHelper::merge(parent::getEventHandlers(), [
            BaseModule::EVENT_USER_AFTER_LOGIN => [
                [EventHandler::class , 'userAfterLogin'],
            ],
            BaseModule::EVENT_USER_AFTER_SIGNUP => [
                [EventHandler::class , 'userAfterSignup'],
            ],
        ]);
    }
}
