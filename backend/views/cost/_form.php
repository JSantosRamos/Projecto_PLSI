<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\Cost $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="cost-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'idUser')->hiddenInput()->label(false) ?>

    <?= $form->field($model, 'title')->textarea(['maxlength' => true]) ?>

    <div class="row">
        <div class="col-md-1">
            <?= $form->field($model, 'valor')->Input('number') ?>
        </div>
        <div class="col">
            <label>Ficheiro</label>
            <?= $form->field($model, 'uploadFile', [
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
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
