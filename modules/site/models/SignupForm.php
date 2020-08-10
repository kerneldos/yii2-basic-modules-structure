<?php


namespace app\modules\site\models;


use yii\base\Model;
use app\models\User;

/**
 * Signup form
 */
class SignupForm extends Model {

    public $username;
    public $email;
    public $password;

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            ['username', 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => 'app\models\User', 'message' => 'This username has already been taken.'],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => 'app\models\User', 'message' => 'This email address has already been taken.'],

            ['password', 'required'],
            ['password', 'string', 'min' => 6],
        ];
    }

    /**
     * Signs user up.
     *
     * @return bool|User
     * @throws \yii\base\Exception
     */
    public function signup() {
        if ( !$this->validate() ) {
            return null;
        }

        $user = new User([
            'username' => $this->username,
            'email' => $this->email,
        ]);

        $user->setPassword($this->password);
        $user->generateAuthKey();

        if (!$user->save()) {
            return false;
        }

        return $user;
    }
}
