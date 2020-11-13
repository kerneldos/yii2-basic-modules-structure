<?php


namespace app\modules\chat\components;


use app\models\User;
use app\modules\chat\events\UserEvent;
use yii\base\Component;

class EventHandler extends Component {

    /**
     * @param UserEvent $event
     */
    public static function userAfterLogin($event) {
        /** @var User $user */
        $user = $event->sender->user->identity;

        \Yii::debug($user);
    }

    /**
     * @param UserEvent $event
     * @throws \Exception
     */
    public static function userAfterSignup($event) {
        /** @var User $user */
        $user = $event->sender->user->identity;

        \Yii::debug($user->username . ' successful registered!');
    }

}