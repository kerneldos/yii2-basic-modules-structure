<?php

namespace app\modules\post\models;


/**
 * This is the model class for table "post".
 *
 * @property int $id
 * @property string $content
 */
class Post extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'post';
    }

    public function behaviors()
    {
        return [
            'yii\behaviors\TimestampBehavior',
            [
                'class' => 'app\components\behaviors\CachedBehavior',
                'cache_id' => ['posts'],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['content'], 'required'],
            [['content'], 'string'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'content' => 'Content',
        ];
    }
}
