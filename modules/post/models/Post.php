<?php

namespace app\modules\post\models;


/**
 * This is the model class for table "post".
 *
 * @property int $id
 * @property string $content
 * @property int $created_at [int(11)]
 * @property int $updated_at [int(11)]
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
