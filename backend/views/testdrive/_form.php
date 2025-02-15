<?php

use common\models\Testdrive;
use kartik\date\DatePicker;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\Testdrive $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="testdrive-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-md-6"><?= $form->field($model, 'idUser')->widget(Select2::className(), [
                'data' => ArrayHelper::map($users, 'id', 'email'),
                'options' => ['placeholder' => 'Selecione uma referência'],
            ]); ?></div>
        <div class="col-md-4"><?= $form->field($model, 'idVehicle')->widget(Select2::className(), [
                'data' => ArrayHelper::map($vehicles, 'id', 'plate'),
                'options' => ['placeholder' => 'Selecione uma referência'],
            ]); ?></div>
    </div>

    <div class="row">
        <div class="col-md-6">    <?= $form->field($model, 'date')->widget(Datepicker::className(), [
                'name' => 'dp_1',
                'type' => DatePicker::TYPE_COMPONENT_PREPEND,
                'value' => '23-Feb-1982',
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
        </div>
        <div class="col-md-6"> <?= $form->field($model, 'time')->dropDownList(['08:00' => '08:00', '09:00' => '09:00', '10:00' => '10:00', '11:00' => '11:00', '12:00' => '12:00', '13:00' => '13:00', '14:00' => '14:00', '15:00' => '15:00', '16:00' => '16:00', '17:00' => '17:00',], ['prompt' => '']) ?></div>
    </div>

    <br>
    <?= $form->field($model, 'description')->textInput() ?>

    <?= $form->field($model, 'status')->dropDownList(['Por ver' => 'Por ver', 'Aceite' => 'Aceite', 'Recusado' => 'Recusado', Testdrive::AGUARDANDO_RESPOSTA => 'Aguardando Resposta']) ?>


    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
