<?php

namespace app\modules\feedback;


/**
 * feedback module definition class
*/
class Module extends \app\components\BaseModule
{
    /**
     * Bootstrap method to be called during application bootstrap stage.
     * @param Application $app the application currently running
     */
    public function bootstrap($app)
    {
        // TODO: Implement bootstrap() method.
    }

    /**
     * Initializes the module.
     */
    public function init()
    {
        parent::init();

        // custom initialization code goes here
        \Yii::configure($this, require __DIR__ . '/config/config.php');
    }
}
