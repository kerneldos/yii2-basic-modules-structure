<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%user}}`.
 */
class m201030_134437_add_group_column_to_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('user', 'group', 'integer');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
    }
}
