<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Testdrive $model */
/** @var common\models\Vehicle $veiculoInfo*/

$this->title = 'Test-drive:' . ' ' . $veiculoInfo->getBrandName() . '(' . $veiculoInfo->getModelName() . ')';
$this->params['breadcrumbs'][] = ['label' => $veiculoInfo->getBrandName() , 'url' => ['/vehicle/view', 'id' => $veiculoInfo->id]];
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
