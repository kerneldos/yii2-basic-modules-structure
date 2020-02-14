<?php

namespace app\modules\post\controllers\frontend;

use yii\web\Controller;

use app\modules\post\models\Post;

/**
 * Default controller for the `post` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index', [
            'models' => Post::find()->all(),
        ]);
    }

    public function actionView($id)
    {
        $model = Post::findOne($id);

        return $this->render('view', [
            'model' => $model,
        ]);
    }
}
