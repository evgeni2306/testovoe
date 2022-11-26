<?php
declare(strict_types=1);

use yii\db\Migration;


class m221105_149826_create_products_table extends Migration
{
    const TABLE_NAME = 'products';

    public function safeUp(): void
    {
        $this->createTable(self::TABLE_NAME, [
            'id' => $this->primaryKey(),
            'creator_id'=>$this->integer(),
            'name' => $this->text()->notNull(),

        ]);
        $this->addForeignKey(
            'products-users',
            self::TABLE_NAME,
            'creator_id',
            'users',
            'id',
        );
    }


    public function safeDown(): void
    {
        $this->dropTable(self::TABLE_NAME);
        $this->dropForeignKey(
            'creator_id',
            'users'
        );
    }
}
