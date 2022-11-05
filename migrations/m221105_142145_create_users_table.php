<?php
declare(strict_types=1);

use yii\db\Migration;


class m221105_142145_create_users_table extends Migration
{
    const TABLE_NAME = 'users';

    public function safeUp(): void
    {
        $this->createTable(self::TABLE_NAME, [
            'id' => $this->primaryKey(),
            'name'=>$this->string(),
            'surname'=>$this->string(),
        ]);
    }


    public function safeDown(): void
    {
        $this->dropTable(self::TABLE_NAME);
    }
}
