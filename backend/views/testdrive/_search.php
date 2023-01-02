<?php

use common\models\Testdrive;
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

    <div class="row">
        <div class="col-md-2"><?php echo $form->field($model, 'idVehicle')->Input('number', ['placeholder' => 'Veículo'])->label(false) ?></div>
        <div class="col-md-2"> <?php echo $form->field($model, 'idUser')->Input('number',['placeholder' => 'NºUtilizador'])->label(false) ?></div>
        <div class="col-md-2"><?php echo $form->field($model, 'status')->dropDownList([Testdrive::POR_VER => 'Por Ver', Testdrive::AGUARDANDO_RESPOSTA => 'Sem Resposta', Testdrive::ACEITE => 'Aceite', Testdrive::RECUSADO => 'Recusado'],
                ['prompt' => 'Todos os estados',])->label(false) ?></div>
    </div>
    <div class="form-group">
        <?= Html::submitButton('Procurar', ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Limpar', ['index'], ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
