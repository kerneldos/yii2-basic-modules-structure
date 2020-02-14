<?php


namespace app\components;

use Yii;
use app\models\Module;
use yii\base\Component;
use yii\base\BootstrapInterface;

class ModuleManager extends Component implements BootstrapInterface
{
    /**
     * @param yii\web\Application $app
     */
    public function bootstrap($app)
    {
        $modules = Module::find()
            ->where(['status' => true])
            ->indexBy('name')
            ->asArray()
            ->all();

        foreach ($modules as $name => $module) {
            Yii::$app->setModule($name, [
                'class' => $module['class'],
            ]);
            Yii::$app->getModule($name)->bootstrap(Yii::$app);
        }

        Yii::$app->getModule('admin')->setModules($modules);
    }
}