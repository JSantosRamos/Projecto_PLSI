<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\Venda $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="venda-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-md-4"><?= $form->field($model, 'idVehicle')->Input('number') ?></div>
        <div class="col-md-4"><?= $form->field($model, 'idUser_buyer')->Input('number') ?></div>
        <div class="col-md-4"><?= $form->field($model, 'Price')->Input('number') ?></div>
    </div>

    <?php if (!empty($message)): ?>
        <div class="alert alert-danger" role="alert"><?= $message ?></div>
    <?php endif; ?>

    <?= $form->field($model, 'comment')->textarea(['maxlength' => true]) ?>

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

