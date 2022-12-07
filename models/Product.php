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

    static function getAll()
    {

        $models = (new \yii\db\Query())
            ->select('id,name,price,id as tags ')
            ->from('products')
            ->all();
        foreach ($models as &$model) {
            $model['tags'] = (new \yii\db\Query())
                ->select('name')
                ->from('tags')
                ->join('left join', 'producttags', 'tags.id=tag_id')
                ->where(['product_id' => $model['id']])
                ->all();

        }
        return $models;
    }
}