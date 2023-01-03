<?php

use kartik\depdrop\DepDrop;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;
use yii\helpers\Url;
use yii\widgets\MaskedInput;
use yii\widgets\Pjax;


/** @var yii\web\View $this */
/** @var common\models\Vendauser $model */
/** @var yii\widgets\ActiveForm $form */

$range = range(2010, 2023);
$mat = 'old';
?>

<div class="vendauser-form">

    <?php Pjax::begin() ?>
    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-md-4"><?= $form->field($model, 'plate')->widget(MaskedInput::class, [
                'mask' => $mat == 'old' ? '[99]-[AA]-[99]' : '[AA]-[99]-[AA]',
            ]) ?></div>
        <div class="col-md-4"><?= $form->field($model, 'brand')->widget(Select2::className(), [
                'data' => ArrayHelper::map($vBrands, 'id', 'name'),
                'options' => ['placeholder' => 'Selecione uma marca', 'id' => 'brand-id'],
            ]);
            ?>
        </div>
        <div class="col-md-4"><?= $form->field($model, 'model')->widget(DepDrop::classname(), [
                'data' => $vModels == "" ? "" : ArrayHelper::map($vModels, 'id', 'name'),
                'options' => ['placeholder' => 'Selecione um modelo'],
                'type' => DepDrop::TYPE_SELECT2,
                'pluginOptions' => [
                    'depends' =>  ['brand-id'],
                    'url' => Url::to(['/vehicle/allmodels']),
                    'loadingText' => '',
                ]
            ]); ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4"><?= $form->field($model, 'mileage')->widget(MaskedInput::class, [
                'name' => 'input-33',
                'clientOptions' => [
                    'alias' => 'decimal',
                    'groupSeparator' => ',',
                    'autoGroup' => true,
                    'removeMaskOnSubmit' => true,
                ]]) ?></div>
        <div class="col-md-4"><?= $form->field($model, 'year')->dropDownList(array_combine($range, $range), ['onchange' => 'plateFunc()']) ?></div>
        <div class="col-md-4"> <?= $form->field($model, 'fuel')->dropDownList(['Diesel' => 'Diesel', 'Gasolina' => 'Gasolina', 'Elétrico' => 'Elétrico', 'GPL' => 'GPL', 'Híbrido' => 'Híbrido',], ['prompt' => '']) ?></div>
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
        <div class="col-md-8"><?= $form->field($model, 'description')->textarea(['maxlength' => true]) ?></div>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Enviar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>
    <?php Pjax::end() ?>

</div>

