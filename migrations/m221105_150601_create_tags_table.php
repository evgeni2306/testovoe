<?php
declare(strict_types=1);

use yii\db\Migration;

/**
 * Handles the creation of table `{{%tags}}`.
 */
class m221105_150601_create_tags_table extends Migration
{
    const TABLE_NAME = 'tags';

    public function safeUp():void
    {
        $this->createTable(self::TABLE_NAME, [
            'id' => $this->primaryKey(),
            'name' => $this->string(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown():void
    {
        $this->dropTable(self::TABLE_NAME);
    }
}
