<?php

namespace app\modules\site\controllers\frontend;

use yii\web\Controller;

/**
 * Default controller for the `site` module
 */
class TestController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        return $this->renderContent('<h1>Action Index</h1>');
    }

    public function actionContact()
    {
        return $this->renderContent('<h1>Action Contact</h1>');
    }
}
