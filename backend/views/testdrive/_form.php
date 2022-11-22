<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\Testdrive $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="testdrive-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'status')->dropDownList([ 'Por ver' => 'Por ver', 'Aceite' => 'Aceite', 'Recusado' => 'Recusado', ]) ?>

    <?= $form->field($model, 'date')->textInput(['disabled' => true]) ?>

    <?php //$form->field($model, 'time')->dropDownList([ '08:00' => '08:00', '09:00' => '09:00', '10:00' => '10:00', '11:00' => '11:00', '12:00' => '12:00', '13:00' => '13:00', '14:00' => '14:00', '15:00' => '15:00', '16:00' => '16:00', '17:00' => '17:00', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'time')->textInput(['disabled' => true]) ?>

    <?= $form->field($model, 'description')->textInput(['disabled' => true]) ?>

    <?= $form->field($model, 'idUser')->textInput(['disabled' => true]) ?>

    <?= $form->field($model, 'idVehicle')->textInput(['disabled' => true]) ?>


    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
