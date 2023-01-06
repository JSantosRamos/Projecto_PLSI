<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;

/** @var yii\web\View $this */
/** @var common\models\UserSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="user-search">

    <?php Pjax::begin(['id' => 'filter_users']) ?>
    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => ['data-pjax' => true]
    ]); ?>

    <div class="row">
        <div class="col-md-2"> <?php echo $form->field($model, 'id')->Input('number',['placeholder' => 'Número do Utilizador'])->label(false) ?></div>
        <div class="col-md-3"><?php echo $form->field($model, 'name')->textInput(['placeholder' => 'Name'])->label(false) ?></div>
        <div class="col-md-3"><?php echo $form->field($model, 'email')->textInput(['placeholder' => 'Email'])->label(false) ?></div>
        <div class="col-md-2"><?php echo $form->field($model, 'isEmployee')->dropDownList(['0' => 'Clientes', '1' => 'Funcionários'], ['prompt' => 'Todos'])->label(false) ?></div>
        <div class="form-group col-md-2">
            <?= Html::submitButton('Procurar', ['class' => 'btn btn-primary']) ?>
            <?= Html::a('Limpar', ['index'], ['class' => 'btn btn-outline-secondary']) ?>
        </div>
    </div>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <?php // echo $form->field($model, 'verification_token') ?>

    <?php // echo $form->field($model, 'name') ?>

    <?php ActiveForm::end(); ?>
    <?php Pjax::end() ?>

</div>
