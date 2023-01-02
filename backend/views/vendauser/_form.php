<?php

use common\models\Vehicle;
use common\models\Vendauser;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\MaskedInput;

/** @var yii\web\View $this */
/** @var common\models\Vendauser $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="vendauser-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-md-4"> <?= $form->field($model, 'brand')->textInput(['disabled' => true, 'value' => Vehicle::getBrandNameById($model->brand)]) ?></div>
        <div class="col-md-4"> <?= $form->field($model, 'model')->textInput(['disabled' => true, 'value' => Vehicle::getModelNameById($model->model)]) ?></div>
        <div class="col-md-4"> <?= $form->field($model, 'serie')->textInput(['disabled' => true]) ?></div>
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
        <div class="col-md-4"> <?= $form->field($model, 'mileage')->textInput(['disabled' => true]) ?></div>
        <div class="col-md-4"> <?= $form->field($model, 'fuel')->textInput(['disabled' => true]) ?></div>
    </div>
    <div class="row">
        <div class="col-md-4"> <?= $form->field($model, 'plate')->textInput(['disabled' => true]) ?></div>
        <div class="col-md-4"> <?= $form->field($model, 'year')->textInput(['disabled' => true]) ?></div>
        <div class="col-md-4">  <?= $form->field($model, 'status')->dropDownList(['Por ver' => 'Por ver', 'Em Análise' => 'Em Análise', 'Aceite' => 'Aceite', 'Recusado' => 'Recusado', Vendauser::AGUARDANDO_RESPOSTA => 'Aguardando Resposta']) ?></div>
    </div>


    <?php //$form->field($model, 'fuel')->dropDownList([ 'Diesel' => 'Diesel', 'Gasolina' => 'Gasolina', 'Elétrico' => 'Elétrico', 'GPL' => 'GPL', 'Híbrido' => 'Híbrido', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'description')->textarea(['disabled' => true]) ?>

    <?= $form->field($model, 'idUser')->hiddenInput()->label(false) ?>

    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>


