<?php


namespace app\modules\post\components;


use app\modules\post\events\UserEvent;
use app\modules\post\models\Author;
use yii\base\Component;

class EventHandler extends Component {

    /**
     * @param UserEvent $event
     */
    public static function userAfterLogin($event) {
        \Yii::debug($event->user->username);
    }

    /**
     * @param UserEvent $event
     * @throws \Exception
     */
    public static function userAfterSignup($event) {
        $author = new Author();
        $author->link('user', $event->user);

        $authManager = \Yii::$app->getAuthManager();

        $role = $authManager->getRole('user');
        $authManager->assign($role, $author->user_id);
    }

}