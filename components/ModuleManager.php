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
    
        Yii::$app->setModules($modules);
        foreach ($modules as $name => $module) {
            Yii::$app->getModule($name)->bootstrap(Yii::$app);
        }

        Yii::$app->getModule('admin')->setModules($modules);
    }
}