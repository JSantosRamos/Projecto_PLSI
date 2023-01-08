<?php

use kartik\select2\Select2;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\VendaSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="venda-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <div class="row">
        <div class="col-md-2">
            <?= $form->field($model, 'idUser_seller')->widget(Select2::className(), [
                'data' => $users,
                'options' => ['placeholder' => 'Selecionar'],
            ]); ?>
        </div>
        <div class="col-md-2">
            <?= $form->field($model, 'idVehicle')->widget(Select2::className(), [
                'data' => $vehicles,
                'options' => ['placeholder' => 'Selecionar'],
            ]); ?>
        </div>
        <div class="form-group">
            <?= Html::submitButton('Procurar', ['class' => 'btn btn-primary']) ?>
            <?= Html::a('Limpar', ['index'], ['class' => 'btn btn-outline-secondary']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
