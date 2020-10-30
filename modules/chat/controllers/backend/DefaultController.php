<?php

namespace app\modules\chat\controllers\backend;

use app\modules\chat\models\Message;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\web\Controller;

/**
 * Default controller for the `chat` module
 */
class DefaultController extends Controller
{
    /**
     * @return string
     */
    public function actionIndex() {
        $messages = Message::find()->indexBy('id')->all();

        if (Model::loadMultiple($messages, \Yii::$app->request->post()) && Model::validateMultiple($messages)) {
            foreach ($messages as $message) {
                $message->save(false);
            }

            return $this->refresh();
        }

        $dataProvider = new ActiveDataProvider([
            'query' => Message::find()->with('user')->where(['is_correct' => 0]),
            'sort' => false,
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }
}
