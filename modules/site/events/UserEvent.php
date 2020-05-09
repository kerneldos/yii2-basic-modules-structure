<?php


namespace app\modules\site\events;


/**
 * Class UserEvent
 * @package app\modules\site\events
 */
class UserEvent extends \yii\base\Event {
    /**
     * @var \app\models\User the identity object associated with this event
     */
    public $user;
}