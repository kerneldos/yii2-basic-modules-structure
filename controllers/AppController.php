<?php


namespace app\controllers;


use Yii;
use yii\caching\CacheInterface;
use yii\web\BadRequestHttpException;
use yii\web\Controller;

class AppController extends Controller
{
    /**
     * @var CacheInterface
     */
    public $cache;

    /**
     * AppController constructor.
     * @param $id
     * @param $module
     * @param array $config
     */
    public function __construct($id, $module, $config = [])
    {
        parent::__construct($id, $module, $config);

        $this->cache = Yii::$app->cache;
    }

    /**
     * @param $action
     * @return bool
     * @throws BadRequestHttpException
     */
    public function beforeAction($action) {
        $clearCacheKey = Yii::$app->request->get('reset-cache');

        if (!empty($clearCacheKey)) {
            $this->cache->flush();
        }

        if (!parent::beforeAction($action)) {
            return false;
        }

        return true;
    }
}