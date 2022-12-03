<?php
declare(strict_types=1);

namespace app\models;


use yii\data\ActiveDataProvider;

class ProductSearch extends Product
{
    public function rules(): array
    {
        return [
            ['name', 'string'],
            ['tags', 'string'],
            [['name', 'price'], 'safe'],
            ['price', 'integer']

        ];
    }

    public function search($params): ActiveDataProvider
    {
        $query = self::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        $this->load($params);
        if (!$this->validate()) {
            return $dataProvider;
        }
        $query->andFilterWhere([
            'price' => $this->price,
        ]);
        $query->andFilterWhere(['like', 'id', $this->id])
            ->andFilterWhere(['like', 'name', $this->name]);
        return $dataProvider;
    }
}