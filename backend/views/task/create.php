<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Task $model */
/** @var common\models\User $employees where isEmployee is (1 == true) */

$this->title = 'Nova Tarefa';
?>
<div class="task-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'employees' => $employees,
        'message' => $message,
    ]) ?>

</div>
