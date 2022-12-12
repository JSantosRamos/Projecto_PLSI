<?php

use kartik\depdrop\DepDrop;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
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
        <div class="col-md-2"><?= $form->field($model, 'idBrand')->widget(Select2::className(), [
                'data' => ArrayHelper::map($brands, 'id', 'name'),
                'options' => ['placeholder' => 'Selecione uma marca', 'id' => 'brand-id'],
            ]);
            ?>
        </div>
        <div class="col-md-2"><?= $form->field($model, 'idModel')->widget(DepDrop::classname(), [

                'data' => $vehicles_models == "" ? "" : ArrayHelper::map($vehicles_models, 'id', 'name'),
                'options' => ['placeholder' => 'Selecione um modelo'],
                'type' => DepDrop::TYPE_SELECT2,
                'pluginOptions' => [
                    'depends' =>  ['brand-id'],
                    'url' => Url::to(['/vehicle/allmodels']),
                    'loadingText' => '',
                ]
            ]); ?>
        </div>
        <div class="col-md-2"><?php echo $form->field($model, 'serie')->textInput() ?></div>
        <div class="col-md-2"><?php echo $form->field($model, 'price')->dropDownList(['1' => '0-15000 EUR', '2' => '15000-30000 EUR', '3' => '30000-45000 EUR', '4' => '45000-60000 EUR', '5' => '60000-75000 EUR', '6' => '75000-90000 EUR', '7' => '90000+ EUR'], ['prompt' => '',]) ?></div>
        <div class="col-md-2"><?php echo $form->field($model, 'fuel')->dropDownList(['Diesel' => 'Diesel', 'Gasolina' => 'Gasolina', 'Elétrico' => 'Elétrico', 'GPL' => 'GPL', 'Híbrido' => 'Híbrido',], ['prompt' => '',]) ?></div>
        <div class="col-md-2"><?php echo $form->field($model, 'mileage')->dropDownList(['1' => '0-25000 km', '2' => '25000-50000 km', '3' => '50000-75000 km', '4' => '75000-100000 km', '5' => '100000-125000 km', '6' => '125000-150000 km', '7' => '150000+ km'], ['prompt' => '',]) ?></div>
        <div class="col-md-2"><?php //echo $form->field($model, 'year')->dropDownList(range(2010, 2023), ['prompt' => '',]) ?></div>
        <div class="col-md-2"><?php //echo $form->field($model, 'price_order_by')->dropDownList(['1' => 'Preço Descendente', '2'=>'Preço Ascendente',], ['prompt' =>'']) ?></div>
    </div>
    <br>
    <div class="form-group">
        <?= Html::submitButton('Procurar', ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Limpar', ['index'], ['class' => 'btn btn-outline-secondary']) ?>
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
