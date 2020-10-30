<?php


namespace app\components;

use Yii;
use yii\base\Component;
use yii\base\BootstrapInterface;

class ModuleManager extends Component implements BootstrapInterface
{
    /**
     * @param yii\web\Application $app
     */
    public function bootstrap($app)
    {
        $modules = [
            'chat' => 'app\modules\chat\Module',
        ];

        $app->setModules($modules);
        foreach ($modules as $name => $module) {
            $app->getModule($name)->bootstrap($app);
        }

        $app->getModule('admin')->setModules($modules);
    }
}