<?php

namespace app\modules\chat\models;

use Yii;

/**
 * This is the model class for table "message".
 *
 * @property int $id
 * @property int $user_id
 * @property int $is_correct
 * @property string $text
 * @property int $created_at
 * @property int $updated_at
 */
class Message extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'message';
    }

    public function behaviors()
    {
        return [
            'yii\behaviors\TimestampBehavior',
        ];
    }

    public function init() {
        parent::init();

        $this->user_id = !Yii::$app->user->isGuest ? Yii::$app->user->identity->getId() : 0;
    }

    public function getUser() {
        return $this->hasOne('app\models\User', ['id' => 'user_id']);
    }

    public function getIsAdminMessage() {
        return $this->user->isAdmin;
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'text'], 'required'],
            [['user_id', 'is_correct', 'created_at', 'updated_at'], 'integer'],
            [['text'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'is_correct' => 'Is Correct',
            'text' => 'Text',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
