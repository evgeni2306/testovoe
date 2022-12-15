<?php
declare(strict_types=1);

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\db\ActiveRecord;

class Product extends ActiveRecord
{
    const SCENARIO_CREATE = 'create';
    const SCENARIO_UPDATE = 'update';


    public static function tableName(): string
    {
        return 'products';
    }

    public function rules(): array
    {
        return [
            ['name', 'string'],
            ['price', 'integer'],
            [['name', 'price', 'tags'], 'required']
        ];
    }

    public function scenarios()
    {
        $scenarios = parent::scenarios();
        $scenarios['create'] = ['name', 'price'];
        return $scenarios;
    }


// для валидации сделать сценарии, тогда и поиск сюда и обновление и проч
    public function getTags(): \yii\db\ActiveQuery
    {
        return $this->hasMany(Tag::class, ['id' => 'tag_id'])
            ->viaTable('producttags', ['product_id' => 'id']);
    }

    public function deleteTags():int
    {
        if (ProductTag::findAll(['product_id' => $this->id]) != null) {
            return ProductTag::deleteAll(['product_id' => $this->id]);
        }
        return 1;
    }
}