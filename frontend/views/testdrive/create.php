<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Testdrive $model */

$this->title = 'Test-drive:' . ' ' . $veiculoInfo->getBrandNameById() . '('. $veiculoInfo->getModelNameById() .')';
$this->params['breadcrumbs'][] = ['label' => 'Testdrives', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="testdrive-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'idVeiculo' => $idVeiculo,
        'veiculoInfo' => $veiculoInfo,
        'dateInvalidMessage' => $dateInvalidMessage
    ]) ?>

</div>
