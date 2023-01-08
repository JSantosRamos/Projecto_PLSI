<?php

use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\MaskedInput;

/** @var yii\web\View $this */
/** @var common\models\Venda $model */
/** @var yii\widgets\ActiveForm $form */

/** @var common\models\User $users lista de utilizadores do tipo clientes para a dropdow */
/** @var common\models\Vehicle $vehicles lista de veiculos para a dropdow */

?>

<div class="venda-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <h4>Dados do Veículo</h4>
        <div class="col-md-3"><?= $form->field($model, 'idVehicle')->widget(Select2::className(), [
                'data' => ArrayHelper::map($vehicles, 'id', 'plate'),
                'options' => ['placeholder' => 'Selecione uma referência'],
            ]); ?></div>
        <div class="col-md-3"><?= $form->field($model, 'price')->widget(MaskedInput::class, [
                'name' => 'input-33',
                'clientOptions' => [
                    'alias' => 'decimal',
                    'groupSeparator' => ',',
                    'autoGroup' => true,
                    'removeMaskOnSubmit' => true,
                ]]) ?></div>

        <h4>Dados de Cliente</h4>
        <div class="col-md-3"><?= $form->field($model, 'name')->textInput() ?>
        </div>

        <div class="col-md-2"><?= $form->field($model, 'number')->widget(MaskedInput::class, [
                'name' => 'phone',
                'mask' => '999 999 999',
                'clientOptions' => [
                    'removeMaskOnSubmit' => true,
                ]
            ]) ?>
        </div>
        <div class="col-md-2"><?= $form->field($model, 'nif')->widget(MaskedInput::class, [
                'name' => 'input-1',
                'mask' => '999 999 999',
                'clientOptions' => [
                    'removeMaskOnSubmit' => true,
                ]
            ]) ?>
        </div>
        <div class="col-md-2"><?= $form->field($model, 'address')->textInput() ?>
        </div>
        <div class="col-md-3"><?= $form->field($model, 'idUser_buyer')->widget(Select2::className(), [
                'data' => ArrayHelper::map($users, 'id', 'email'),
                'options' => ['placeholder' => 'Selecione um cliente (opcional)'],
            ]); ?></div>
    </div>

    <?php if (!empty($message)): ?>
        <div class="alert alert-danger" role="alert"><?= $message ?></div>
    <?php endif; ?>

    <?= $form->field($model, 'comment')->textarea(['maxlength' => true, 'placeholder' => 'Opcional...']) ?>

    <div class="form-group">
        <?= Html::submitButton('Guardar', [
            'class' => 'btn btn-primary',
            'data' => Yii::$app->controller->action->id == 'create' ? ['confirm' => 'Tem a certeza que pretende registar esta venda? Depois de criada não pode ser alterada.'] : [],
        ]) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

