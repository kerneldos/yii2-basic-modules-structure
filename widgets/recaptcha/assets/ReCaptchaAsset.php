<?php

namespace app\widgets\recaptcha\assets;

use yii\web\AssetBundle;

class ReCaptchaAsset extends AssetBundle
{
    public $sourcePath = '@app/widgets/recaptcha/web';
    public $jsOptions = ['position' => \yii\web\View::POS_END];

    public $css = [

    ];
    public $js = [
        '//www.google.com/recaptcha/api.js',
        'recaptcha.script.js',
    ];
}
