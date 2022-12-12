<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Product $model */

$this->title = 'Добавить продукт';
$this->params['breadcrumbs'][] = ['label' => 'Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="country-create">

    <h1><?= Html::encode($this->title) ?></h1>

        <?= $this->render('_form', [
            'model' => $model,
        ]) ?>
<!--    <form method="post" action="create">-->
<!--        <div class="grid">-->
<!--            --><?// echo Html:: hiddenInput(\Yii:: $app->getRequest()->csrfParam, \Yii:: $app->getRequest()->getCsrfToken(), []); ?>
<!--            <input name="name" type="text" placeholder="Введите имя" class="inputField">-->
<!--            <input name="price" type="text" placeholder="Введите цену" class="inputField">-->
<!--             <input name="tag" type="text" placeholder="Введите тэг" class="inputField">-->
<!--            <input value="Создать" type='submit' class="inputField">-->
<!---->
<!--        </div>-->
<!--    </form>-->

</div>
