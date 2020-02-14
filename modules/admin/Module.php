<?php

namespace app\modules\admin;

use app\components\exceptions\ForbiddenExceptions;

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
//                'denyCallback' => function($rule, $action) {
//                    throw new ForbiddenExceptions('Доступ запрещён!', 'Для данного типа пользователя - доступ запрещён!');
//                }
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();

//        $modules = \app\models\Module::find()->indexBy('name')->asArray()->all();
//        $this->setModules($modules);

        \Yii::configure($this, require __DIR__ . '/config/config.php');
    }
}
