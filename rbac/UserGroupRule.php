<?php


namespace app\rbac;

use Yii;
use yii\rbac\Rule;

/**
 * Checks if user group matches
 */
class UserGroupRule extends Rule {
    public $name = 'userGroup';

    public function execute($user, $item, $params) {
        if ( !Yii::$app->user->isGuest ) {
            $group = Yii::$app->user->identity->group;

            if ( $item->name == 'admin' ) {
                return $group == 0;
            } elseif ( $item->name == 'user' ) {
                return $group == 0 || $group == 1;
            }
        }

        return false;
    }
}