<?php


namespace app\controllers;


use app\models\Product;
use yii\web\Controller;
use Yii;


class ProductController extends Controller
{
    public function actionAdd()
    {
        $model = new Product();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
//dd($model);
//            $model->creator_id=5;
//            var_dump($model);
$model->save();
//            echo 'ok';
        } else {
            return $this->render('form', ['model' => $model]);
        }
    }
}