<?php

namespace app\modules\chat\controllers\frontend;

use app\modules\chat\models\Message;
use Yii;
use yii\data\ActiveDataProvider;
use yii\data\Pagination;
use yii\web\Controller;

/**
 * Default controller for the `chat` module
 */
class DefaultController extends Controller
{
    public $layout = 'main';

    public function behaviors() {
        return [
            'access' => [
                'class' => 'yii\filters\AccessControl',
                'only' => ['set-incorrect'],
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['admin'],
                    ],
                ],
            ],
        ];
    }

    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex() {
        $model = new Message();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->goHome();
        }

        $query = Message::find()->with('user')->orderBy(['created_at' => SORT_DESC]);
        $countQuery = clone $query;

        $pager = new Pagination([
            'pageSize' => 5,
            'defaultPageSize' => 5,
            'totalCount' => $countQuery->count(),
        ]);

        $dataProvider = new ActiveDataProvider([
            'query' =>  $query->offset($pager->offset)->limit($pager->limit),
            'pagination' => false,
        ]);

        $render = 'render' . (Yii::$app->request->isAjax ? 'Partial' : '');

        return $this->$render('index', [
            'dataProvider' => $dataProvider,
            'model' => $model,
            'pager' => $pager,
        ]);
    }

    public function actionSetIncorrect($id) {
        $message = Message::findOne($id);

        $message->is_correct = 0;
        $message->save();

        return $this->goHome();
    }
}
