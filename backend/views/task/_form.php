<?php

use common\models\User;
use kartik\datetime\DateTimePicker;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\Task $model */
/** @var yii\widgets\ActiveForm $form */

$sessionId = Yii::$app->user->getId();
?>

<div class="task-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'type')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textarea(['maxlength' => true]) ?>

    <?= $form->field($model, 'date')->widget(DateTimePicker::className(), [
        'name' => 'datetime_10',
        'options' => ['placeholder' => 'Select operating time ...'],
        'convertFormat' => true,
        'pluginOptions' => [
            'format' => 'd-M-Y g:i A',
            'startDate' => '01-Mar-2014 12:00 AM',
            'todayHighlight' => true
        ]
    ]) ?>

    <?php if (!$formupdate) {
        echo $form->field($model, 'idAssigned_to')->dropDownList($employees, ['prompt' => 'Funcionário a atribuir']);
    } else {
        if ($formupdate && (User::isManager($sessionId) || User::isAdmin($sessionId))) {
            echo $form->field($model, 'idAssigned_to')->dropDownList($employees, ['prompt' => 'Funcionário a atribuir']);
        } else {
            echo $form->field($model, 'idAssigned_to')->dropDownList($employees, ['disabled' => true]);
        }
    } ?>

    <?php  ?>

    <?= $form->field($model, 'status')->dropDownList(['Por iniciar' => 'Por iniciar', 'Em Processo' => 'Em Processo', 'Finalizado' => 'Finalizado',]) ?>

    <?= $form->field($model, 'idCreated_by')->hiddenInput(['value' => $idUser])->label(false) ?>

    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
