<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Reserve $model */

$this->title = 'Reserva:' . ' ' . $vehicle->getBrandName() . '(' . $vehicle->getModelName() . ')';
$this->params['breadcrumbs'][] = ['label' => $vehicle->getBrandName() , 'url' => ['/vehicle/view', 'id' => $vehicle->id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="reserve-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        '$vehicle' =>$vehicle,
    ]) ?>

</div>
