<?php
declare(strict_types=1);

namespace app\models;

use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

class Product extends ActiveRecord
{
    const SCENARIO_CREATE = 'create';
    const SCENARIO_UPDATE = 'update';

    public $tg;

    //Сделал поиск отдельным классом, т.к возникала проблема с несуществующими в таблице переменными тега
    public static function tableName(): string
    {
        return 'products';
    }

    public function rules(): array
    {
        return [
            ['name', 'string'],
            ['price', 'integer'],
            [['name', 'price', 'tg'], 'required']
        ];
    }

    public function scenarios(): array
    {
        $scenarios = parent::scenarios();
        $scenarios['create'] = ['name', 'price'];
        return $scenarios;
    }


// для валидации сделать сценарии, тогда и поиск сюда и обновление и проч
    public function getTags(): ActiveQuery
    {
        return $this->hasMany(Tag::class, ['id' => 'tag_id'])
            ->viaTable('producttags', ['product_id' => 'id']);
    }

    public function deleteTags(): int
    {
        if (ProductTag::findAll(['product_id' => $this->id]) != null) {
            return ProductTag::deleteAll(['product_id' => $this->id]);
        }
        return 1;
    }

    public function addTags(array $tags):void
    {
        foreach ($tags as $tag) {
            $productTag = new ProductTag(['product_id' => $this->id, 'tag_id' => $tag]);
            $productTag->save();
        }
    }
}