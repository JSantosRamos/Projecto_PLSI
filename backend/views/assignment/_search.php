<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;

/** @var yii\web\View $this */
/** @var backend\models\AuthAssignmentSearch $modelPermissons */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="auth-assignment-search">

    <?php Pjax::begin(['id' => 'filter_permissons']) ?>
    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => ['data-pjax' => true]
    ]); ?>

    <div class="row">
        <div class="col-md-2"> <?= $form->field($modelPermissons, 'user_id')->Input('number', ['placeholder' => 'Procurar por Nº']) ?></div>
        <div class="col-md-2"><?= $form->field($modelPermissons, 'item_name')->dropDownList(['admin' => 'Admin', 'manager' => 'Manager', 'employee' => 'Funcionário', 'customer' => 'customer'], ['prompt' => 'Todos',]) ?></div>
    </div>
    <div class="form-group">
        <?= Html::submitButton('Procurar', ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Limpar', ['index'], ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
    <?php Pjax::end() ?>

</div>
