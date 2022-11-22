<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\Vendauser $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="vendauser-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'status')->dropDownList([ 'Por ver' => 'Por ver', 'Em Análise' => 'Em Análise', 'Aceite' => 'Aceite', 'Recusado' => 'Recusado', ]) ?>

    <?= $form->field($model, 'brand')->textInput(['disabled' => true]) ?>

    <?= $form->field($model, 'model')->textInput(['disabled' => true]) ?>

    <?= $form->field($model, 'serie')->textInput(['disabled' => true]) ?>

    <?= $form->field($model, 'price')->textInput(['disabled' => true]) ?>

    <?= $form->field($model, 'mileage')->textInput(['disabled' => true]) ?>

    <?php //$form->field($model, 'fuel')->dropDownList([ 'Diesel' => 'Diesel', 'Gasolina' => 'Gasolina', 'Elétrico' => 'Elétrico', 'GPL' => 'GPL', 'Híbrido' => 'Híbrido', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'fuel')->textInput([ 'disabled' => true]) ?>

    <?= $form->field($model, 'year')->textInput(['disabled' => true]) ?>

    <?= $form->field($model, 'plate')->textInput(['disabled' => true]) ?>

    <?= $form->field($model, 'description')->textInput(['disabled' => true]) ?>

    <?= $form->field($model, 'date')->textInput(['disabled'=>true]) ?>

    <?= $form->field($model, 'idUser')->hiddenInput()->label(false) ?>

    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>


