<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Tag $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="tag-form">

    <?php $form = ActiveForm::begin(); ?>

<!--    --><?//= $form->field($model, 'code')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

<!--    --><?//= $form->field($model, 'price')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Cохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
