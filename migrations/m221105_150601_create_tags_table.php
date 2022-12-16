<?php
declare(strict_types=1);

use yii\db\Migration;


class m221105_150601_create_tags_table extends Migration
{
    const TABLE_NAME = 'tags';

    public function safeUp(): void
    {
        $this->createTable(self::TABLE_NAME, [
            'id' => $this->primaryKey(),
            'creator_id'=>$this->integer(),
            'name' => $this->string(),

        ]);
        $this->addForeignKey(
            'tags-users',
            self::TABLE_NAME,
            'creator_id',
            'users',
            'id',
        );
    }

    public function safeDown(): void
    {
        $this->dropTable(self::TABLE_NAME);
    }
}
