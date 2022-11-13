<?php
declare(strict_types=1);

namespace app\models;


use yii\base\Model;
use yii\db\ActiveRecord;

class Product extends ActiveRecord
{
//    public  $name;

    public static function tableName():string
    {
        return 'products';
    }

    public function rules(): array
    {
        return [
            ['name', 'required'],
            ['name', 'string'],

        ];
    }
}