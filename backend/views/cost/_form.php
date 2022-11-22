<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\Cost $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="cost-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'idUser')->textInput() ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'valor')->textInput() ?>

    <?= $form->field($model, 'file')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
