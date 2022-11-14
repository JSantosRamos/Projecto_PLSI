<?php

use dosamigos\ckeditor\CKEditor;
use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\Vehicle $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="vehicle-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->widget(CKEditor::class, [
        'options' => ['rows' => 6],
        'preset' => 'basic'
    ]) ?>

    <?= $form->field($model, 'plate')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'brand')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'model')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'serie')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'type')->dropDownList(['Cabrio' => 'Cabrio', 'Carrinha' => 'Carrinha', 'Desportivo' => 'Desportivo', 'SUV' => 'SUV', 'Utilitário' => 'Utilitário',], ['prompt' => '']) ?>

    <?= $form->field($model, 'fuel')->dropDownList(['Diesel' => 'Diesel', 'Gasolina' => 'Gasolina', 'Elétrico' => 'Elétrico', 'GPL' => 'GPL', 'Híbrido' => 'Híbrido',], ['prompt' => '']) ?>

    <?= $form->field($model, 'mileage')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'engine')->textInput() ?>

    <?= $form->field($model, 'color')->dropDownList(['Branco' => 'Branco', 'Preto' => 'Preto', 'Cinzento' => 'Cinzento', 'Vermelho' => 'Vermelho', 'Laranja' => 'Laranja', 'Amarelo' => 'Amarelo', 'Verde' => 'Verde', 'Azul' => 'Azul', 'Castanho' => 'Castanho',], ['prompt' => '']) ?>

    <?= $form->field($model, 'year')->textInput() ?>

    <?= $form->field($model, 'doorNumber')->textInput() ?>

    <?= $form->field($model, 'transmission')->dropDownList(['Manual' => 'Manual', 'Automático' => 'Automático',], ['prompt' => '']) ?>

    <?= $form->field($model, 'price')->textInput() ?>

    <?= $form->field($model, 'imageFile', [
        'template' => '
                <div class="custom-file">
                    {input}
                    {label}
                    {error}
                </div>
            ',
        'labelOptions' => ['class' => 'custom-file-label'],
        'inputOptions' => ['class' => 'custom-file-input']
    ])->textInput(['type' => 'file']) ?>

    <?= $form->field($model, 'isActive')->checkbox() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
