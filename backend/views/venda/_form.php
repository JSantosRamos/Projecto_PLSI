<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\Venda $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="venda-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'idUser_buyer')->textInput() ?>

    <?= $form->field($model, 'idVehicle')->textInput() ?>

    <?= $form->field($model, 'Price')->textInput() ?>

    <?= $form->field($model, 'comment')->textarea(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

