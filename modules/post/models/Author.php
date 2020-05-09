<?php


namespace app\modules\post\models;


use app\models\User;

/**
 * @property int $id [int(11)]
 * @property int $user_id [int(11)]
 * @property string $avatar [varchar(255)]
 * @property User $user
 */
class Author extends \yii\db\ActiveRecord {
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'author';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['avatar'], 'string'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'avatar' => 'Avatar',
        ];
    }

    public function getUser() {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }
}