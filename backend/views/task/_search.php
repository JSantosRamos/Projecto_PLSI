<?php

use common\models\Task;
use common\models\User;
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

    <div class="row">
        <div class="col-md-2"><?php echo $form->field($model, 'id')->Input('number', ['placeholder' => 'Nº da Tarefa'])->label(false) ?></div>
        <?php if (!User::isEmployee(Yii::$app->user->id)): ?>
            <div class="col-md-2"> <?php echo $form->field($model, 'idAssigned_to')->Input('number', ['placeholder' => 'Utilizador'])->label(false) ?></div>
        <?php endif; ?>

        <div class="col-md-2"><?php echo $form->field($model, 'status')->dropDownList([Task::Por_INICIAR => 'Por Iniciar', Task::EM_PROCESSO => 'A decorrer', Task::FINALIZADA => 'Finalizada'],
                ['prompt' => '  Todos',])->label(false) ?></div>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Procurar', ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Limpar', ['index'], ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
