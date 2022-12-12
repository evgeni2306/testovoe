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

    public $name;
    public $price;
//    public $tag;
//    public $scenario;

    public static function tableName(): string
    {
        return 'products';
    }

    public function rules(): array
    {
        return [
            ['name', 'string'],
            ['price', 'integer'],
            [['name', 'price'], 'required']
//            ['name', 'string','on'=>self::SCENARIO_CREATE],
//            ['price', 'integer','on'=>self::SCENARIO_CREATE],
//            [['name', 'price'], 'required','on'=>self::SCENARIO_CREATE],
//            ['price', 'integer', 'on' => self::SCENARIO_UPDATE],
//            ['price', 'integer', 'on' => self::SCENARIO_CREATE]

        ];
    }

    public function scenarios()
    {
        $scenarios = parent::scenarios();
        $scenarios['create'] = ['name', 'price'];
        return $scenarios;
    }


//
//    public function saveProduct()
//    {
//        $posts = Yii::$app->db->createCommand('INSERT INTO products(name,price) VALUES(' . '"'.$this->name. '"' . ',' . $this->price . ')')
//            ->query();
//    }

// для валидации сделать сценарии, тогда и поиск сюда и обновление и проч
    public function getTags()
    {
        return $this->hasMany(Tag::class, ['id' => 'tag_id'])
            ->viaTable('producttags', ['product_id' => 'id']);
    }


}