<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\VendaSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="venda-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'idUser_seller') ?>

    <?= $form->field($model, 'idUser_buyer') ?>

    <?= $form->field($model, 'idVehicle') ?>

    <?= $form->field($model, 'Price') ?>

    <?php // echo $form->field($model, 'comment') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
