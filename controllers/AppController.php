<?php


namespace app\controllers;


use app\components\BaseModule;
use app\models\LoginForm;
use app\models\SignupForm;
use app\modules\chat\events\UserEvent;
use Yii;
use yii\base\Event;
use yii\web\Response;

class AppController extends \yii\web\Controller {
    /**
     * @return array|string[]
     */
    public function actions() {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin() {

        if ( !Yii::$app->user->isGuest ) {
            return $this->goHome();
        }

        $model = new LoginForm();

        if ( $model->load(Yii::$app->request->post()) && $model->login() ) {
            Yii::$app->trigger(BaseModule::EVENT_USER_AFTER_LOGIN);

            return Yii::$app->user->can('adminPanel') ? $this->redirect('/admin') : $this->goBack();
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

        if ( $model->load(Yii::$app->request->post()) ) {
            if ( ($user = $model->signup()) != false ) {
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