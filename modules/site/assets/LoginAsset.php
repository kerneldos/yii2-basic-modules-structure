<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\modules\site\assets;

use yii\web\AssetBundle;

/**
 * Main application asset bundle.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class LoginAsset extends AssetBundle
{
    public $sourcePath = '@app/modules/site/web';
    public $css = [
        'http://allfont.ru/allfont.css?fonts=droid-serif',
        'css/login.css',
    ];
    public $js = [
        'js/cadesplugin_api.js',
        'js/login.js',
    ];
    public $depends = [
        'yii\bootstrap\BootstrapAsset',
    ];
}
