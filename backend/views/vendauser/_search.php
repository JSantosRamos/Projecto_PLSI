<?php

use common\models\Vendauser;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\VendauserSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="vendauser-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <div class="row">
        <div class="col-md-2"> <?= $form->field($model, 'idUser')->textInput(['placeholder' => 'NºUtilizador'])->label(false) ?></div>
        <div class="col-md-2"> <?= $form->field($model, 'brand')->textInput(['placeholder' => 'Marca'])->label(false) ?></div>
        <div class="col-md-2"> <?= $form->field($model, 'model')->textInput(['placeholder' => 'Modelo'])->label(false) ?></div>
        <div class="col-md-2"> <?= $form->field($model, 'serie')->textInput(['placeholder' => 'Serie'])->label(false) ?></div>
        <div class="col-md-2"><?php echo $form->field($model, 'status')->dropDownList([Vendauser::POR_VER => 'Por Ver', Vendauser::EM_ANALISE => 'Em Análise', Vendauser::AGUARDANDO_RESPOSTA => 'Sem Resposta', Vendauser::ACEITE => 'Aceite', Vendauser::RECUSADO =>'Recusado'],
                ['prompt' => '  Todos',])->label(false) ?></div>
    </div>

    <?php // $form->field($model, 'id') ?>

    <?php // echo $form->field($model, 'mileage') ?>

    <?php // echo $form->field($model, 'fuel') ?>

    <?php // echo $form->field($model, 'year') ?>

    <?php // echo $form->field($model, 'description') ?>

    <?php // echo $form->field($model, 'status') ?>

    <div class="form-group">
        <?= Html::submitButton('Procurar', ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Limpar', ['index'], ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
