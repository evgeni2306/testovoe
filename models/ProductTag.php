<?php
declare(strict_types=1);

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\db\ActiveRecord;

class ProductTag extends  ActiveRecord
{
    public static function tableName(): string
    {
        return 'producttags';
    }

    public function rules(): array
    {
        return [
            [['product_id','tag_id'],'integer','required']

        ];
    }
}