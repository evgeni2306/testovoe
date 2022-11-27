<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Tag $model */

$this->title = 'Добавить тэг';
$this->params['breadcrumbs'][] = ['label' => 'Tags', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="country-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
