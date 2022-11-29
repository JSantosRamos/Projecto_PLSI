<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;


/** @var yii\web\View $this */
/** @var common\models\User $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="user-form">
    <?php $form = ActiveForm::begin();
    ?>

    <div class="row mt-3">
        <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'password_hash')->passwordInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'email')->Input('email') ?>

        <div class="col-md-4"><?= $form->field($model, 'nif')->Input('number') ?></div>

        <div class="col-md-4"><?= $form->field($model, 'number')->Input('number') ?></div>

        <div class="col-md-4"><?= $form->field($model, 'status')->dropDownList(['10' => 'Ativo', '9' => 'Desativa']) ?></div>
    </div>

    <?= $form->field($model, 'isEmployee')->checkbox() ?>

    <br>
    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
