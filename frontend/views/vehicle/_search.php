<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;

/** @var yii\web\View $this */
/** @var common\models\VehicleSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="vehicle-search">

    <?php Pjax::begin(['id' => 'filter_show_vehicles']) ?>
    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => ['data-pjax' => true]
    ]); ?>

    <h5>Procurar por:</h5>
    <div class="row">
        <div class="col-md-4"><?php echo $form->field($model, 'title')->textInput(['placeholder' => 'Pesquisar...'])->label(false) ?></div>
        <div class="col-md-2"> <?php echo $form->field($model, 'brand')->textInput(['placeholder' => 'Marca'])->label(false) ?></div>
        <div class="col-md-2"><?php echo $form->field($model, 'price')->textInput(['placeholder' => 'Preço'])->label(false) ?></div>
    </div>
    <br>
    <div class="form-group">
        <?= Html::submitButton('Procurar', ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Reset', ['index'], ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php //$form->field($model, 'id') ?>

    <?php //$form->field($model, 'brand') ?>

    <?php //$form->field($model, 'model') ?>

    <?php //$form->field($model, 'serie') ?>

    <?php //$form->field($model, 'type') ?>

    <?php // echo $form->field($model, 'fuel') ?>

    <?php // echo $form->field($model, 'mileage') ?>

    <?php // echo $form->field($model, 'engine') ?>

    <?php // echo $form->field($model, 'color') ?>

    <?php // echo $form->field($model, 'description') ?>

    <?php // echo $form->field($model, 'year') ?>

    <?php // echo $form->field($model, 'doorNumber') ?>

    <?php // echo $form->field($model, 'transmission') ?>

    <?php // echo $form->field($model, 'price') ?>

    <?php // echo $form->field($model, 'image') ?>

    <?php // echo $form->field($model, 'isActive') ?>

    <?php ActiveForm::end(); ?>
    <?php Pjax::end() ?>


</div>
