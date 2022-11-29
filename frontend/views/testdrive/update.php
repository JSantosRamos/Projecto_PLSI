<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Testdrive $model */

$this->title = 'Alterar pedido de Testdrive: #' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Testdrives', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="testdrive-update">

    <h2><?= Html::encode($this->title) ?></h2>

    <?= $this->render('_form', [
        'model' => $model,
        'idVeiculo' => $idVeiculo,
        'dateInvalidMessage' => $dateInvalidMessage,
    ]) ?>

</div>
