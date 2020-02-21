<?php


namespace app\widgets;


class Pre extends \yii\bootstrap\Widget {

    public $message;

    public function run() {
        return $this->render('pre', [
            'message' => $this->message,
        ]);
    }
}