<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%module}}`.
 */
class m191216_095058_add_status_column_to_module_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('module', 'status', 'boolean');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
    }
}
