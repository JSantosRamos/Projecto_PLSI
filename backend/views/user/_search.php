<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\UserSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="user-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?php  echo $form->field($model, 'email') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <?php // echo $form->field($model, 'verification_token') ?>

    <?php // echo $form->field($model, 'name') ?>

    <?php // echo $form->field($model, 'nif') ?>

    <?php // echo $form->field($model, 'number') ?>

    <div class="form-group">
        <?= Html::submitButton('Procurar', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
