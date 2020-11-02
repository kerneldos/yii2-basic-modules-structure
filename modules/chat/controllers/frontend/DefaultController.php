<?php

namespace app\modules\chat\controllers\frontend;

use app\components\BaseModule;
use app\controllers\AppController;
use app\modules\chat\events\UserEvent;
use app\modules\chat\models\LoginForm;
use app\modules\chat\models\Message;
use app\modules\chat\models\SignupForm;
use Yii;
use yii\web\Response;

/**
 * Default controller for the `chat` module
 */
class DefaultController extends AppController
{
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

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

        $messages = Message::find()->with('user')->all();

        return $this->render('index', [
            'messages' => $messages,
            'model' => $model,
        ]);
    }

    public function actionSetIncorrect($id) {
        $message = Message::findOne($id);

        $message->is_correct = 0;
        $message->save();

        return $this->goHome();
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin() {

        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();

        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            Yii::$app->trigger(BaseModule::EVENT_USER_AFTER_LOGIN, new UserEvent([
                'user' => Yii::$app->user->identity,
            ]));

            return Yii::$app->user->identity->isAdmin
                ? $this->redirect('/admin')
                : $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Signs user up.
     *
     * @return mixed
     * @throws \yii\base\Exception
     */
    public function actionSignup() {
        $model = new SignupForm();

        if ($model->load(Yii::$app->request->post())) {
            if (($user = $model->signup()) != false) {
                Yii::$app->session->setFlash('success', 'Thank you for registration.');

                Yii::$app->trigger(BaseModule::EVENT_USER_AFTER_SIGNUP, new UserEvent([
                    'user' => $user,
                ]));

                return $this->goHome();
            }
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout() {
        Yii::$app->user->logout();

        return $this->goHome();
    }
}
