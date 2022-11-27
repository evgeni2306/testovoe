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
            ['tags','string'],
            [['name', 'price'], 'safe'],
            ['price', 'integer']

        ];
    }

    public function search($params): ActiveDataProvider
    {
        $query = self::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

//        $query->joinWith(['tags' => function($query) { $query->from(['tags' => 'products']); }]);
//// добавляем сортировку по колонке из зависимости
//        $dataProvider->sort->attributes['tags.name'] = [
//            'asc' => ['tags.name' => SORT_ASC],
//            'desc' => ['tags.name' => SORT_DESC],
//        ];



//        поиск слово-в-слово
        $query->andFilterWhere([
            'price' => $this->price,
        ]);

        $query->andFilterWhere(['like', 'id', $this->id])
            ->andFilterWhere(['like', 'name', $this->name]);

        return $dataProvider;
    }
}