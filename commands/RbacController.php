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
        $auth = Yii::$app->getAuthManager();
        $auth->removeAll();

        $admin = Yii::$app->authManager->createRole('admin');
        $admin->description = 'Администратор';
        Yii::$app->authManager->add($admin);

        $user = Yii::$app->authManager->createRole('user');
        $user->description = 'Пользователь';
        Yii::$app->authManager->add($user);

        $fl = Yii::$app->authManager->createRole('FL');
        $fl->description = 'ФЛ';
        Yii::$app->authManager->add($fl);

        $ip = Yii::$app->authManager->createRole('IP');
        $ip->description = 'ИП';
        Yii::$app->authManager->add($ip);

        $ul = Yii::$app->authManager->createRole('UL');
        $ul->description = 'ЮЛ';
        Yii::$app->authManager->add($ul);

        $auth->addChild($user, $fl);
        $auth->addChild($user, $ip);
        $auth->addChild($user, $ul);

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