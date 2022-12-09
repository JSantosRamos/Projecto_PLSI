<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Task $model */
/** @var common\models\User $employees where isEmployee is (1 == true) */

$this->title = 'Tarefa: #' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Tasks', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="task-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'employees' => $employees,
    ]) ?>

</div>
