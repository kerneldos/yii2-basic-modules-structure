<?php

namespace app\modules\admin;


/**
 * admin module definition class
 */
class Module extends \yii\base\Module
{
    public $homeUrl = 'admin';

    /**
     * {@inheritdoc}
     */
    public $controllerNamespace = 'app\modules\admin\controllers';

    public function behaviors()
    {
        return [
            'access' => [
                'class' => 'yii\filters\AccessControl',
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['admin'],
                    ],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();

        \Yii::configure($this, require __DIR__ . '/config/config.php');
    }

    public static function getEventHandlers() {
        return [];
    }
}
