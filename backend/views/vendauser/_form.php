<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\Vendauser $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="vendauser-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'idUser')->textInput() ?>

    <?= $form->field($model, 'price')->textInput() ?>

    <?= $form->field($model, 'reason')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'date')->textInput() ?>

    <?= $form->field($model, 'plate')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'mileage')->textInput() ?>

    <?= $form->field($model, 'fuel')->dropDownList([ 'Diesel' => 'Diesel', 'Gasolina' => 'Gasolina', 'Elétrico' => 'Elétrico', 'GPL' => 'GPL', 'Híbrido' => 'Híbrido', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'year')->textInput() ?>

    <?= $form->field($model, 'brand')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'model')->textInput() ?>

    <?= $form->field($model, 'serie')->textInput() ?>

    <?= $form->field($model, 'description')->textInput() ?>

    <?= $form->field($model, 'status')->dropDownList([ 'Por ver' => 'Por ver', 'Pendente' => 'Pendente', 'Aceite' => 'Aceite', 'Recusado' => 'Recusado', ], ['prompt' => '']) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
