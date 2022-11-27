<?php
declare(strict_types=1);

namespace app\models;


use yii\data\ActiveDataProvider;

class TagSearch extends Tag
{
    public function rules(): array
    {
        return [
            ['name', 'string'],
            ['name',  'safe'],

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

//        поиск слово-в-слово
//        $query->andFilterWhere([
//            'price' => $this->price,
//        ]);

        $query->andFilterWhere(['like', 'id', $this->id])
            ->andFilterWhere(['like', 'name', $this->name]);

        return $dataProvider;
    }
}