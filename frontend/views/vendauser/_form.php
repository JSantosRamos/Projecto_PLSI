<?php

use etsoft\widgets\YearSelectbox;
use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\Vendauser $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="vendauser-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'plate')->textInput(['maxlength' => 8, 'placeholder' => '00-AA-00']) ?>

    <?= $form->field($model, 'mileage')->Input('number') ?>

    <?= $form->field($model, 'brand')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'model')->textInput() ?>

    <?= $form->field($model, 'serie')->textInput() ?>

    <?= $form->field($model, 'fuel')->dropDownList(['Diesel' => 'Diesel', 'Gasolina' => 'Gasolina', 'Elétrico' => 'Elétrico', 'GPL' => 'GPL', 'Híbrido' => 'Híbrido',], ['prompt' => '']) ?>

    <?php echo $form->field($model, 'year')->widget(YearSelectbox::classname(), [
        'yearStart' => 2010,
        'yearStartType' => 'fix',
        'yearEnd' => 2022,
        'yearEndType' => 'fix',
    ]);
    ?>

    <?= $form->field($model, 'price')->Input('number') ?>

    <?= $form->field($model, 'description')->textarea(['maxlength' => true]) ?>

    <?= $form->field($model, 'idUser')->textInput(['value' => $idUser]) ?>

    <div class="form-group">
        <?= Html::submitButton('Enviar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
