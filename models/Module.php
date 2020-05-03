<?php

namespace app\models;

use yii\db\ActiveRecord;

/**
 * This is the model class for table "module".
 *
 * @property int $id
 * @property string $name
 * @property string $class
 * @property boolean $status
 * @property int $created_at
 * @property int $updated_at
 */
class Module extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'module';
    }

    public function behaviors()
    {
        return [
            'yii\behaviors\TimestampBehavior',
            'app\components\behaviors\CachedBehavior',
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'class', 'created_at', 'updated_at'], 'required'],
            [['created_at', 'updated_at'], 'integer'],
            [['name', 'class'], 'string', 'max' => 255],
            [['name'], 'unique'],
            [['status'], 'boolean'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'class' => 'Class',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
