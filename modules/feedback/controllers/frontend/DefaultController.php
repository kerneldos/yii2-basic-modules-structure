<?php

namespace app\modules\feedback\controllers\frontend;

use app\controllers\AppController;

/**
 * Default controller for the `feedback` module
 */
class DefaultController extends AppController
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }
}
