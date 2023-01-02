<?php

use dosamigos\ckeditor\CKEditor;
use kartik\depdrop\DepDrop;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;
use yii\helpers\Url;
use yii\widgets\MaskedInput;

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


    <div class="row">
        <div class="col-md-4"><?= $form->field($model, 'plate')->textInput(['maxlength' => true]) ?></div>
        <div class="col-md-4"><?= $form->field($model, 'type')->dropDownList(['Cabrio' => 'Cabrio', 'Carrinha' => 'Carrinha', 'Desportivo' => 'Desportivo', 'SUV' => 'SUV', 'Utilitário' => 'Utilitário',], ['prompt' => '']) ?></div>
        <div class="col-md-4"><?= $form->field($model, 'fuel')->dropDownList(['Diesel' => 'Diesel', 'Gasolina' => 'Gasolina', 'Elétrico' => 'Elétrico', 'GPL' => 'GPL', 'Híbrido' => 'Híbrido',], ['prompt' => '']) ?></div>
    </div>


    <div class="row">
        <div class="col-md-4"><?= $form->field($model, 'idBrand')->widget(Select2::className(), [
                'data' => ArrayHelper::map($brands, 'id', 'name'),
                'options' => ['placeholder' => 'Selecione uma marca', 'id' => 'brand-id'],
            ]);
            ?>
        </div>

        <div class="col-md-4"><?= $form->field($model, 'idModel')->widget(DepDrop::classname(), [
                'data' => $vehicles_models == "" ? "" : ArrayHelper::map($vehicles_models, 'id', 'name'),
                'options' => ['placeholder' => 'Selecione um modelo'],
                'type' => DepDrop::TYPE_SELECT2,
                'pluginOptions' => [
                    'depends' =>  ['brand-id'],
                    'url' => Url::to(['/vehicle/allmodels']),
                    'loadingText' => '',
                ]
            ]); ?>
        </div>
        <div class="col-md-4"><?= $form->field($model, 'serie')->textInput(['maxlength' => true]) ?></div>
    </div>

    <div class="row">
        <div class="col-md-4"> <?= $form->field($model, 'mileage')->Input('number') ?></div>
        <div class="col-md-4"><?= $form->field($model, 'engine')->Input('number') ?></div>
        <div class="col-md-4"><?= $form->field($model, 'cv')->Input('number') ?></div>
    </div>

    <div class="row">
        <div class="col-md-4"><?= $form->field($model, 'color')->dropDownList(['Branco' => 'Branco', 'Preto' => 'Preto', 'Cinzento' => 'Cinzento', 'Vermelho' => 'Vermelho', 'Laranja' => 'Laranja', 'Amarelo' => 'Amarelo', 'Verde' => 'Verde', 'Azul' => 'Azul', 'Castanho' => 'Castanho',], ['prompt' => '']) ?></div>
        <div class="col-md-4"><?= $form->field($model, 'year')->textInput() ?></div>
        <div class="col-md-4"><?= $form->field($model, 'transmission')->dropDownList(['Manual' => 'Manual', 'Automático' => 'Automático',], ['prompt' => '']) ?></div>
    </div>

    <div class="row">
        <div class="col-md-4"><?= $form->field($model, 'price')->widget(MaskedInput::class, [
                'name' => 'input-33',
                'clientOptions' => [
                    'alias' => 'decimal',
                    'groupSeparator' => ',',
                    'autoGroup' => true,
                    'removeMaskOnSubmit' => true,
                ]]) ?></div>
        <div class="col-md-4"><?= $form->field($model, 'status')->dropDownList(['Disponível' => 'Disponível', 'Vendido' => 'Vendido', 'Reservado' => 'Reservado',]) ?></div>
        <div class="col-md-4"><?= $form->field($model, 'doorNumber')->Input('number') ?></div>
    </div>


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
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
