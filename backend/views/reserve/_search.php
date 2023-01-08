<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\ReserveSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="reserve-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'idUser') ?>

    <?= $form->field($model, 'idVehicle') ?>

    <?= $form->field($model, 'number') ?>

    <?= $form->field($model, 'nif') ?>

    <?php // echo $form->field($model, 'morada') ?>

    <?php // echo $form->field($model, 'cc') ?>

    <?php // echo $form->field($model, 'create_at') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
