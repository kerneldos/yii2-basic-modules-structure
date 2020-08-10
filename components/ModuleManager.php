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

        $app->setModules($modules);
        foreach ($modules as $name => $module) {
            $app->getModule($name)->bootstrap($app);
        }

        $app->getModule('admin')->setModules($modules);
    }
}