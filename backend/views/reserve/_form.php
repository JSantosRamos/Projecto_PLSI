<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\Reserve $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="reserve-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'idUser')->textInput() ?>

    <?= $form->field($model, 'idVehicle')->textInput() ?>

    <?= $form->field($model, 'number')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nif')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'morada')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'cc')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'create_at')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
