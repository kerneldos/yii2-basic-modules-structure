<?php


namespace app\modules\chat\events;


/**
 * Class UserEvent
 * @package app\modules\chat\events
 */
class UserEvent extends \yii\base\Event {
    /**
     * @var \app\models\User the identity object associated with this event
     */
    public $user;
}