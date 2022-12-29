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

    public function actionView(int $id): string
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);

    }

    public function actionCreate(): string
    {
        if ($this->request->isPost) {
            $model = new Product(['scenario' => Product::SCENARIO_CREATE]);
            $model->load(Yii::$app->request->post());
            if ($model->validate()) {
                $model->save();
                $tags = Yii::$app->request->post()['Product']['tg'];
                $model->addTags($tags);
                return $this->actionView($model->id);
            }
        }
        $model = new Product();
        return $this->render('create', [
            'model' => $model,
        ]);
    }

    public function actionUpdate(int $id): string|Response
    {
        $model = $this->findModel($id);
        $model->tg = $model->tags;

        if ($this->request->isPost && $model->load($this->request->post())) {
            $model->save();
            if ($model->deleteTags()) {
                $model->addTags($model->tg);
                return $this->actionView($model->id);
            }
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    public function actionSearch(): string
    {
        $model = new ProductSearch();
        $model->attributes = Yii::$app->request->get();
        $results = [];
        if ($model->validate()) {
            $results = $model->searchProduct();
        }
        return $this->render('index', [
            'models' => $results,
        ]);


    }

    public function actionDelete(int $id): Response
    {
        $model = $this->findModel($id);
        if ($model->deleteTags()) {
            $this->findModel($id)->delete();
        }
        return $this->redirect(['index']);
    }


    protected function findModel(int $id): Product
    {
        $model = Product::find()->with(['tags'])->where(['id' => $id])->one();
        if ($model != null) {
            return $model;
        }
        throw new NotFoundHttpException('The requested page does not exist.');
    }
}