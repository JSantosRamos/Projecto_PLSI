<?php

use common\models\User;
use kartik\datetime\DateTimePicker;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\Task $model */
/** @var yii\widgets\ActiveForm $form */

$sessionId = Yii::$app->user->getId();
$fieldDisable = false;

if (Yii::$app->controller->action->id == 'update' && User::isEmployee(Yii::$app->user->id)) {
    $fieldDisable = true;
}
?>

<div class="task-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'type')->textInput(['maxlength' => true, 'disabled' => $fieldDisable]) ?>

    <?= $form->field($model, 'description')->textarea(['maxlength' => true, 'disabled' => $fieldDisable]) ?>

    <?= $form->field($model, 'date')->widget(DateTimePicker::className(), [
        'name' => 'dp_2',
        'options' => ['placeholder' => 'Selecionar', 'disabled' => $fieldDisable],
        'type' => DateTimePicker::TYPE_COMPONENT_PREPEND,
        'value' => '23-Feb-1982 10:01',
        'pluginOptions' => [
            'autoclose' => true,
            'format' => 'dd-mm-yyyy hh:ii',
            'todayHighlight' => true
        ]
    ]) ?>
    <?php
    if (!empty($message)) { ?>
        <div class="text-danger">
            <?php echo $message; ?>
        </div>
    <?php } ?>

    <?= $form->field($model, 'idAssigned_to')->dropDownList($employees, ['disabled' => $fieldDisable]) ?>

    <?= $form->field($model, 'status')->dropDownList(['Por iniciar' => 'Por iniciar', 'Em Processo' => 'Em Processo', 'Finalizado' => 'Finalizado',]) ?>

    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
