<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\VendauserSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="vendauser-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'idUser') ?>

    <?= $form->field($model, 'price') ?>

    <?= $form->field($model, 'date') ?>

    <?= $form->field($model, 'plate') ?>

    <?php // echo $form->field($model, 'mileage') ?>

    <?php // echo $form->field($model, 'fuel') ?>

    <?php // echo $form->field($model, 'year') ?>

    <?php // echo $form->field($model, 'brand') ?>

    <?php // echo $form->field($model, 'model') ?>

    <?php // echo $form->field($model, 'serie') ?>

    <?php // echo $form->field($model, 'description') ?>

    <?php // echo $form->field($model, 'status') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
