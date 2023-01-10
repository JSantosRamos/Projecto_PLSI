<?php

use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;
use yii\widgets\MaskedInput;

/** @var yii\web\View $this */
/** @var common\models\Reserve $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="reserve-form">
    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <div class="container rounded bg-white mt-5 mb-5">
        <div class="row" style="background: #e9ecef">
            <div class="col-md-3 border-right">
            </div>
            <div class="col-md-5 border-right">
                <div class="p-3 py-5">
                    <div class="row mt-3">

                        <h3><?= Yii::$app->user->identity->name; ?></h3>

                        <?= $form->field($model, 'idUser')->hiddenInput()->label(false) ?>

                        <?= $form->field($model, 'idVehicle')->hiddenInput()->label(false) ?>

                        <div class="col-md-6">
                            <?= $form->field($model, 'number')->widget(MaskedInput::class, [
                                'name' => 'phone',
                                'mask' => '999 999 999',
                                'clientOptions' => [
                                    'removeMaskOnSubmit' => true,
                                ]
                            ]) ?>
                        </div>
                        <div class="col-md-6">
                            <?= $form->field($model, 'nif')->widget(MaskedInput::class, [
                                'name' => 'phone',
                                'mask' => '999 999 999',
                                'clientOptions' => [
                                    'removeMaskOnSubmit' => true,
                                ]
                            ]) ?>
                        </div>
                        <?= $form->field($model, 'morada')->textInput(['maxlength' => true]) ?>

                        <?= $form->field($model, 'ccFile', [])->textInput(['type' => 'file']) ?>

                        <div class="form-group">
                            <?= Html::submitButton('Reservar', ['id' => 'btReservar', 'class' => 'btn btn-success']) ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php ActiveForm::end(); ?>
</div>
<style>
    #btReservar {
        float: right;
    }
</style>