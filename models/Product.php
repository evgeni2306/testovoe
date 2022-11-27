<?php
declare(strict_types=1);

namespace app\models;


use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\db\ActiveRecord;

class Product extends ActiveRecord
{

    public static function tableName(): string
    {
        return 'products';
    }

    public function rules(): array
    {
        return [
            ['name', 'string'],
            [['name', 'price'], 'required'],
            ['price', 'integer']

        ];
    }

    public function getTags()
    {
        return $this->hasMany(Tag::class, ['id' => 'tag_id'])
            ->viaTable('productTags', ['product_id' => 'id']);


    }
}