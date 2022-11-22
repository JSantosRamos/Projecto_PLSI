<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\TestdriveSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="testdrive-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?php  echo $form->field($model, 'idVehicle') ?>

    <div class="form-group">
        <?= Html::submitButton('Procurar', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
