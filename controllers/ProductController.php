<?php

declare(strict_types=1);

namespace app\controllers;

use app\models\Product;

use app\models\ProductSearch;
use Yii;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response;
use function Codeception\Lib\Console\with;


class ProductController extends Controller
{
    public function behaviors(): array
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    public function actionIndex(): string
    {
        $models = Product::find()->with(['tags'])->all();
        return $this->render('index', [
            'models' => $models,
        ]);
    }

    public function actionView($id): string
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);

    }

    public function actionCreate()
    {
//        $this->enableCsrfValidation = false;
        if ($this->request->isPost) {
            dd(Yii::$app->request->post());
            $model = new Product(['scenario' => Product::SCENARIO_CREATE]);
            $model->load(Yii::$app->request->post());
            dd($model);
            if ($model->validate()) {
                $model->save();
            }

            dd($model->price);
        }
        $model = new Product();
        return $this->render('create', [
            'model' => $model,
        ]);
//            if ($model->load($this->request->post()) && $model->save()) {
//                dd($model);
//                return $this->redirect(['view', 'id' => $model->id]);
//            }
//        } else {
//            $model->loadDefaultValues();
//        }


    }

    public function actionUpdate($id): string|Response
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    public function actionSearch(): string
    {
        $get = Yii::$app->request->get();
        $model = new ProductSearch();
        $model->attributes = $get;
        $products = [];
        if ($model->validate()) {
            $products = $model->searchProduct();
        }
        return $this->render('index', [
            'models' => $products,
        ]);


    }

    public function actionDelete($id): Response
    {

        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }


    protected function findModel($id): Product
    {
        if (($model = Product::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}