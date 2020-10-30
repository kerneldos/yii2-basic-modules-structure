<?php


namespace app\modules\chat\components;


use app\modules\chat\events\UserEvent;
use yii\base\Component;

class EventHandler extends Component {

    /**
     * @param UserEvent $event
     */
    public static function userAfterLogin($event) {
        \Yii::debug($event->user->email);
    }

    /**
     * @param UserEvent $event
     * @throws \Exception
     */
    public static function userAfterSignup($event) {
        $auth = \Yii::$app->authManager;
        $authorRole = $auth->getRole('user');
        $auth->assign($authorRole, $event->user->getId());
    }

}