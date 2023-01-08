<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\AuthAssignment $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="auth-assignment-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'item_name')->dropDownList($roles) ?>

    <?= $form->field($model, 'user_id')->textInput(['maxlength' => true]) ?>

    <?php //$form->field($model, 'created_at')->textInput() ?>

    <br>
    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
