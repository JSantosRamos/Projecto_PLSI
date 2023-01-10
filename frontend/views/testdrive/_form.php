<?php

use kartik\date\DatePicker;
use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\Testdrive $model */
/** @var yii\widgets\ActiveForm $form */

?>

<div class="testdrive-form">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css">

    <?php $form = ActiveForm::begin(); ?>
    <div class="container rounded bg-white mt-5 mb-5">
        <div class="row" style="background: #e9ecef">
            <div class="col-md-3 border-right">
            </div>
            <div class="col-md-5 border-right">
                <div class="p-3 py-5">
                    <div class="row mt-3">

                        <?= $form->field($model, 'date')->widget(Datepicker::className(), [
                            'name' => 'dp_1',
                            'type' => DatePicker::TYPE_COMPONENT_PREPEND,
                            'options' => ['placeholder' => "Selecione uma data."],
                            'pluginOptions' => [
                                'autoclose' => true,
                                'format' => 'dd-mm-yyyy'
                            ]
                        ]) ?>

                        <?php
                        if (!empty($dateInvalidMessage)) { ?>
                            <div class="text-danger">
                                <?php echo $dateInvalidMessage; ?>
                            </div>
                        <?php } ?>

                        <?= $form->field($model, 'time')->dropDownList(['08:00' => '08:00', '09:00' => '09:00', '10:00' => '10:00', '11:00' => '11:00', '12:00' => '12:00', '13:00' => '13:00', '14:00' => '14:00', '15:00' => '15:00', '16:00' => '16:00', '17:00' => '17:00',], ['prompt' => '']) ?>
                        <?= $form->field($model, 'description')->textarea(['rows' => 3]) ?>

                        <?= $form->field($model, 'idUser')->hiddenInput()->label(false) ?>
                        <?= $form->field($model, 'idVehicle')->hiddenInput(['value' => $idVeiculo])->label(false) ?>

                        <div class="form-group">
                            <?= Html::submitButton('Enviar', ['id' => 'btEnviar', 'class' => 'btn btn-success']) ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php ActiveForm::end(); ?>

</div>

<style>
    #btEnviar {
        float: right;
    }
</style>