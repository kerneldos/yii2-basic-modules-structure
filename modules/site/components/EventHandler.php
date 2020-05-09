<?php


namespace app\modules\site\components;


use app\modules\site\events\UserEvent;
use yii\base\Component;

class EventHandler extends Component {

    /**
     * @param UserEvent $event
     */
    public static function userAfterLogin($event) {
        \Yii::debug($event->user->email);
    }

}