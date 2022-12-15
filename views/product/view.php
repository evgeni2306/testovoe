<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Product $model */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
$this->registerCssFile("@web/css/product.css", [], 'css-print-theme');
?>
<div class="product-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы действительно хотите удалить этот объект??',
                'method' => 'post',
            ],
        ]) ?>
    </p>


        <div class="grid">
            <div class="gridItem"><?= Html::encode($model['id']) ?></div>
            <div class="gridItem"><?= Html::encode($model['name']) ?></div>
            <div class="gridItem"><?= Html::encode($model['price']) . ' Р' ?></div>
            <div class="gridItem gridTag ">
                <? foreach ($model['tags'] as $tag) { ?>
                    <div class='tag'><? echo $tag['name'] ?></div>
                <? } ?>

            </div>

        </div>

</div>
