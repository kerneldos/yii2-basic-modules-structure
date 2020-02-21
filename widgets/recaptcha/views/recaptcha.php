<?php
/* @var $this \yii\web\View */
/* @var $siteKey string */

use app\widgets\recaptcha\assets\ReCaptchaAsset;

ReCaptchaAsset::register($this);
?>

<div class="form-group">
    <div class="g-recaptcha" data-sitekey="<?= $siteKey ?>"></div>
</div>
