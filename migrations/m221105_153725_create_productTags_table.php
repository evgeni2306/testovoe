<?php
declare(strict_types=1);

use yii\db\Migration;


class m221105_153725_create_productTags_table extends Migration
{
    const TABLE_NAME = "productTags";

    public function safeUp(): void
    {
        $this->createTable(self::TABLE_NAME, [
            'id' => $this->primaryKey(),
            'product_id'=>$this->integer(),
            'tag_id'=>$this->integer(),

        ]);
        $this->addForeignKey(
            'products-productTags',
            self::TABLE_NAME,
            'product_id',
            'products',
            'id',

        );
        $this->addForeignKey(
            'tags-productTags',
            self::TABLE_NAME,
            'tag_id',
            'tags',
            'id',

        );
    }

    public function safeDown():void
    {
        $this->dropTable(self::TABLE_NAME);
    }
}
