<?php

namespace app\modules\site\controllers\backend;

use yii\web\Controller;

/**
 * Default controller for the `site` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionContact()
    {
        return $this->renderContent('<h1>OK</h1>');
    }
}
