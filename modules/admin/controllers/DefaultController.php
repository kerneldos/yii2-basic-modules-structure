<?php

namespace app\modules\admin\controllers;

use app\controllers\AppController;
use app\models\User;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * Default controller for the `admin` module
 */
class DefaultController extends AppController
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => 'yii\filters\VerbFilter',
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Module models.
     * @return mixed
     */
    public function actionIndex()
    {
        $users = User::find()->indexBy('id')->all();

        if (Model::loadMultiple($users, Yii::$app->request->post()) && Model::validateMultiple($users)) {
            foreach ($users as $id => $user) {
                if ($user->isAttributeChanged('group', false)) {
                    $user->save(false);

                    $authManager = Yii::$app->getAuthManager();

                    $rolesList = User::getRolesList();
                    $role = $authManager->getRole($rolesList[$user->group]);

                    $authManager->revokeAll($id);
                    $authManager->assign($role, $id);
                }
            }

            return $this->refresh();
        }

        $dataProvider = new ActiveDataProvider([
            'query' => User::find()->indexBy('id'),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'roles' => User::getRolesList(),
        ]);
    }
}
