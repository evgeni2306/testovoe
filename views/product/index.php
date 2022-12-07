<?php

use app\models\Product;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\Product $models */

$this->title = 'Продукты';
$this->params['breadcrumbs'][] = $this->title;
$this->registerCssFile("@web/css/product.css", [], 'css-print-theme');
?>

<div class="product-index">
    <h1><?= Html::encode($this->title) ?></h1>
    <p>
        <?= Html::a('Добавить продукт', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <div class="grid">
        <div class="gridItem">id</div>
        <div class="gridItem">name</div>
        <div class="gridItem">price</div>
        <div class="gridItem">tags</div>
        <div class="gridItem">actions</div>
    </div>
    <form method="get" action="search">
        <div class="grid">

            <input name="id" type="text" placeholder="Введите id" class="inputField">
            <input name="name" type="text" placeholder="Введите имя" class="inputField">
            <input name="price" type="text" placeholder="Введите цену" class="inputField">
            <input name="tag" type="text" placeholder="Введите тэг" class="inputField">
            <input value="Поиск" type='submit' class="inputField">

        </div>
    </form>
    <? foreach ($models as $model) { ?>
        <div class="grid">
            <div class="gridItem"><?= Html::encode($model['id']) ?></div>
            <div class="gridItem"><?= Html::encode($model['name']) ?></div>
            <div class="gridItem"><?= Html::encode($model['price']) . ' Р' ?></div>
            <div class="gridItem gridTag ">
                <? foreach ($model['tags'] as $tag) { ?>
                    <div class='tag'><? echo $tag['name'] ?></div>
                <? } ?>

            </div>
            <div class="gridItem">
                <?= Html::a('Смотреть', ['view', 'id' => $model['id']], ['class' => 'viewButton actionButton']) ?>
                <?= Html::a('Обновить', ['update', 'id' => $model['id']], ['class' => 'updateButton actionButton']) ?>
                <?= Html::a('Удалить', ['delete', 'id' => $model['id']], [
                    'class' => 'deleteButton actionButton   ',
                    'data' => [
                        'confirm' => 'Вы действительно хотите удалить этот объект??',
                        'method' => 'post',
                    ],
                ]) ?>
            </div>
        </div>
    <? } ?>
    <!--    --><?php //// echo $this->render('_search', ['model' => $searchModel]); ?>
    <!--    --><? //= GridView::widget([
    //        'dataProvider' => $dataProvider,
    //        'filterModel' => $searchModel,
    //        'columns' => [
    //            'id',
    //            'name',
    //            'price',
    //            'tags.name',
    //            [
    //                'class' => ActionColumn::className(),
    //                'urlCreator' => function ($action, Product $model, $key, $index, $column) {
    //                    return Url::toRoute([$action, 'id' => $model->id]);
    //                 }
    //            ],
    //        ],
    //    ]); ?>


</div>
