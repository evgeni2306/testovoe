<?php
declare(strict_types=1);

namespace app\models;


use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\db\ActiveRecord;

class ProductSearch extends Model
{
    public $id;
    public $name;
    public $price;
    public $tag;

    public function rules(): array
    {
        return [
            [['name', 'tag'], 'integer'],
            [['id', 'price'], 'integer'],

        ];
    }

    public function searchProduct(): array
    {
        $results = Product::find()
            ->leftJoin('producttags', 'products.id = product_id')
            ->leftJoin('tags', 'tags.id = tag_id')
            ->filterWhere(['products.id' => $this->id, 'price' => $this->price,])
            ->andFilterWhere(['like', 'products.name', $this->name])
            ->andFilterWhere(['like', 'tags.name', $this->tag])
            ->all();
        return $results;
    }
}