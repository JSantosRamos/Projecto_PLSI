<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\MaskedInput;

/** @var yii\web\View $this */
/** @var common\models\Cost $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="cost-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'idUser')->hiddenInput()->label(false) ?>

    <?= $form->field($model, 'title')->textarea(['maxlength' => true]) ?>

    <div class="row">

        <div class="col-md-2"><?= $form->field($model, 'valor')->widget(MaskedInput::class, [
                'name' => 'input-33',
                'clientOptions' => [
                    'alias' => 'decimal',
                    'groupSeparator' => ',',
                    'autoGroup' => true,
                    'removeMaskOnSubmit' => true,
                ]]) ?></div>

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
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
