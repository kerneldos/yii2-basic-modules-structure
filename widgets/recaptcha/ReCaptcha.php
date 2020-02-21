<?php


namespace app\widgets\recaptcha;


class ReCaptcha extends \yii\bootstrap\Widget {

    public $siteKey = '6LfQjdkUAAAAAK-tY1DcVvH_b0qUEB6__4Fq5lMq';

    public function run() {
        return $this->render('recaptcha', [
            'siteKey' => $this->siteKey,
        ]);
    }
}