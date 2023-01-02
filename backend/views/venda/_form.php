<?php

use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\MaskedInput;

/** @var yii\web\View $this */
/** @var common\models\Venda $model */
/** @var yii\widgets\ActiveForm $form */

?>

<div class="venda-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-md-4"><?= $form->field($model, 'idVehicle')->widget(Select2::className(), [
                'data' => ArrayHelper::map($vehicles, 'id', 'plate'),
                'options' => ['placeholder' => 'Selecione uma referência'],
            ]); ?></div>
        <div class="col-md-4"><?= $form->field($model, 'idUser_buyer')->widget(Select2::className(), [
                'data' => ArrayHelper::map($users, 'id', 'email'),
                'options' => ['placeholder' => 'Selecione uma cliente'],
            ]); ?></div>
        <div class="col-md-4"><?= $form->field($model, 'Price')->widget(MaskedInput::class, [
                'name' => 'input-33',
                'clientOptions' => [
                    'alias' => 'decimal',
                    'groupSeparator' => ',',
                    'autoGroup' => true,
                    'removeMaskOnSubmit' => true,
                ]]) ?></div>
    </div>

    <?php if (!empty($message)): ?>
        <div class="alert alert-danger" role="alert"><?= $message ?></div>
    <?php endif; ?>

    <?= $form->field($model, 'comment')->textarea(['maxlength' => true, 'placeholder' => 'Opcional...']) ?>

    <div class="form-group">
        <?= Html::submitButton('Guardar', [
            'class' => 'btn btn-success',
            'data' => [
                'confirm' => 'Tem a certeza que pretende registar esta venda? Depois de criada não pode ser alterada.',
            ],
        ]) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

