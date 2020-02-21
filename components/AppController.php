<?php


namespace app\components;


use yii\web\BadRequestHttpException;
use yii\web\Controller;

class AppController extends Controller
{
    public $cache;

    public function __construct($id, $module, $config = [])
    {
        $this->cache = \Yii::$app->cache;

        parent::__construct($id, $module, $config);
    }

    /**
     * @param $action
     * @return bool
     * @throws BadRequestHttpException
     */
    public function beforeAction($action) {
        $clearCacheKey = \Yii::$app->request->get('reset-cache');
        if (!empty($clearCacheKey)) {
            $this->cache->flush();
        }
        
        return parent::beforeAction($action);
    }
}