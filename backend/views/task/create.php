<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Task $model */

$this->title = 'Nova Tarefa';
?>
<div class="task-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'idUser' => $idUser,
        'employees' => $employees,
        'formupdate' => false
    ]) ?>

</div>
