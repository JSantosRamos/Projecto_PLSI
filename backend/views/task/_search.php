<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\TaskSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="task-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?php // echo $form->field($model, 'idCreated_by') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php  echo $form->field($model, 'idAssigned_to') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
