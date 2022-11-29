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

    <div class="row">
        <div class="col-md-4"> <?php echo $form->field($model, 'id')->textInput(['placeholder' => 'Número do Utilizador'])->label(false) ?></div>
        <div class="col-md-4"><?php echo $form->field($model, 'email')->textInput(['placeholder' => 'Email'])->label(false) ?></div>
        <div class="col-md-4"><?php echo $form->field($model, 'isEmployee')->dropDownList(['0' =>'Clientes', '1' =>'Funcionários'], ['prompt' => 'Todos'])->label(false) ?></div>
    </div>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <?php // echo $form->field($model, 'verification_token') ?>

    <?php // echo $form->field($model, 'name') ?>

    <?php // echo $form->field($model, 'nif') ?>

    <?php // echo $form->field($model, 'number') ?>

    <div class="form-group">
        <?= Html::submitButton('Procurar', ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Reset', ['index'], ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
