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
class DefaultController extends AppController {
    /**
     * {@inheritdoc}
     */
    public function behaviors() {
        return [
            'verbs' => [
                'class'   => 'yii\filters\VerbFilter',
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * @return mixed
     * @throws \Exception
     */
    public function actionIndex() {
        /** @var User[] $users */
        $users = User::find()->indexBy('id')->all();

        if ( Model::loadMultiple($users, Yii::$app->request->post()) && Model::validateMultiple($users) ) {
            foreach ($users as $userId => $user) {
                if ( $user->isAttributeChanged('group', false) ) {
                    $user->save(false);

                    $authManager = Yii::$app->getAuthManager();

                    $roleName = User::getRoleName($user->group);
                    $role     = $authManager->getRole($roleName);

                    $authManager->revokeAll($userId);
                    $authManager->assign($role, $userId);
                }
            }

            return $this->refresh();
        }

        $dataProvider = new ActiveDataProvider([
            'query' => User::find()->indexBy('id'),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'roles'        => User::getRolesList(),
        ]);
    }
}
