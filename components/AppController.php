<?php


namespace app\components;


use yii\web\Controller;

class AppController extends Controller
{
    public $cache;

    public function __construct($id, $module, $config = [])
    {
        $this->cache = \Yii::$app->cache;

        parent::__construct($id, $module, $config);
    }
}