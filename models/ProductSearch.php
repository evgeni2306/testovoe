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

    public function searchProduct()
    {
        $products = (new \yii\db\Query())
            ->select('products.id')
            ->from('products')
            ->join('left join', 'producttags', 'products.id=product_id')
            ->join('left join', 'tags', 'tags.id=tag_id')
            ->filterWhere([
                'products.id' => $this->id,
                'products.name' => $this->name,
                'price' => $this->price,
                'tags.name' => $this->tag,

            ])->distinct()->all();

        dd($products);
//        $models = (new \yii\db\Query())
//            ->select('id,name,price,id as tags ')
//            ->from('products')
//            ->all();
//        foreach ($models as &$model) {
//            $model['tags'] = (new \yii\db\Query())
//                ->select('name')
//                ->from('tags')
//                ->join('left join', 'producttags', 'tags.id=tag_id')
//                ->where(['product_id' => $model['id']])
//                ->all();
//
//        }
    }
}