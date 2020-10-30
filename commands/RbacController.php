<?php


namespace app\commands;


use app\models\User;
use Yii;
use yii\console\Controller;
use yii\console\Exception;
use yii\helpers\ArrayHelper;

class RbacController extends Controller
{
    public function actionInit()
    {
        $auth = Yii::$app->authManager;

        // добавляем разрешение "createMessage"
        $createMessage = $auth->createPermission('createMessage');
        $createMessage->description = 'Create a Message';
        $auth->add($createMessage);

        // добавляем разрешение "updateMessage"
        $updateMessage = $auth->createPermission('updateMessage');
        $updateMessage->description = 'Update Message';
        $auth->add($updateMessage);

        // добавляем роль "user" и даём роли разрешение "createMessage"
        $user = $auth->createRole('user');
        $auth->add($user);
        $auth->addChild($user, $createMessage);

        // добавляем роль "admin" и даём роли разрешение "updateMessage"
        // а также все разрешения роли "user"
        $admin = $auth->createRole('admin');
        $auth->add($admin);
        $auth->addChild($admin, $updateMessage);
        $auth->addChild($admin, $user);

        $this->stdout('Done!' . PHP_EOL);
    }

    public function actionAssign()
    {
        $authManager = Yii::$app->getAuthManager();

        $username = $this->prompt('Username:', ['required' => true]);
        $user = $this->findModel($username);

        $roleName = $this->select('Role:', ArrayHelper::map($authManager->getRoles(), 'name', 'description'));
        $role = $authManager->getRole($roleName);

        $authManager->assign($role, $user->id);

        $this->stdout('Done!' . PHP_EOL);
    }

    /**
     * Removes role from user
     */
    public function actionRevoke()
    {
        $username = $this->prompt('Username:', ['required' => true]);
        $user = $this->findModel($username);
        $roleName = $this->select('Role:', ArrayHelper::merge(
            ['all' => 'All Roles'],
            ArrayHelper::map(Yii::$app->authManager->getRolesByUser($user->id), 'name', 'description'))
        );
        $authManager = Yii::$app->getAuthManager();
        if ($roleName == 'all') {
            $authManager->revokeAll($user->id);
        } else {
            $role = $authManager->getRole($roleName);
            $authManager->revoke($role, $user->id);
        }
        $this->stdout('Done!' . PHP_EOL);
    }

    public function actionAddAdminPerm() {
        $auth = Yii::$app->authManager;

        // добавляем разрешение "adminPanel"
        $adminPanel = $auth->createPermission('adminPanel');
        $adminPanel->description = 'Access to Admin Panel';
        $auth->add($adminPanel);

        $admin = $auth->getRole('admin');
        $auth->addChild($admin, $adminPanel);
    }

    /**
     * @param string $username
     * @throws \yii\console\Exception
     * @return User the loaded model
     */
    private function findModel($username)
    {
        if (!$model = User::findOne(['username' => $username])) {
            throw new Exception('User is not found');
        }
        return $model;
    }
}