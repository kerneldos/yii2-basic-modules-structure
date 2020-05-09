<?php


namespace app\modules\post\events;


/**
 * Class UserEvent
 * @package app\modules\post\events
 */
class UserEvent extends \yii\base\Event {
    /**
     * @var \app\models\User the identity object associated with this event
     */
    public $user;
}