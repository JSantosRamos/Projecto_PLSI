<?php

use kartik\date\DatePicker;
use kartik\datetime\DateTimePicker;
use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\Testdrive $model */
/** @var yii\widgets\ActiveForm $form */

?>

<div class="testdrive-form">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'date')->widget(Datepicker::className(), [
        'name' => 'dp_1',
        'type' => DatePicker::TYPE_COMPONENT_PREPEND,
        'value' => '23-Feb-1982',
        'pluginOptions' => [
            'autoclose' => true,
            'format' => 'dd-M-yyyy'
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

    <?= $form->field($model, 'idUser')->hiddenInput(['value' => $idUser])->label(false) ?>

    <?= $form->field($model, 'idVehicle')->hiddenInput(['value' => $idVeiculo])->label(false) ?>

    <div class="form-group">
        <?= Html::submitButton('Enviar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
