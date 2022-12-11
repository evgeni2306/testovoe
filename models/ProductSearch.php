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
//            [['name', 'tag', 'id', 'price'], 'default', 'value' => null],
            [['name', 'tag'], 'string'],
            [['id', 'price'], 'integer'],

        ];
    }

    public function searchProduct():array
    {
        $models = Product::find()->with(['tags'])->filterWhere([
                'products.id' => $this->id,
                'price' => $this->price,
            ])
            ->andFilterWhere(['like', 'products.name', $this->name])
            ->andFilterWhere(['like', 'tags.name', $this->tag])->all();
        return $models;
//        $products = (new \yii\db\Query())
//            ->select('products.id,products.name,price,products.id as tags ')
//            ->from('products')
//            ->join('left join', 'producttags', 'products.id=product_id')
//            ->join('left join', 'tags', 'tags.id=tag_id')
//            ->filterWhere([
//                'products.id' => $this->id,
//                'price' => $this->price,
//            ])
//            ->andFilterWhere(['like', 'products.name', $this->name])
//            ->andFilterWhere(['like', 'tags.name', $this->tag])
//            ->distinct()->all();
//
//
//        foreach ($products as &$model) {
//            $model['tags'] = (new \yii\db\Query())
//                ->select('tags.name')
//                ->from('tags')
//                ->join('left join', 'producttags', 'tags.id=tag_id')
//                ->where(['product_id' => $model['id']])
//                ->all();
//
//        }
//        return $products;
    }
}