<?php
declare(strict_types=1);

namespace app\models;

use yii\db\ActiveRecord;

class Tag extends  ActiveRecord
{
    public static function tableName(): string
    {
        return 'tags';
    }

    public function rules(): array
    {
        return [
            ['name', 'string'],
            ['name',  'required'],
        ];
    }

}