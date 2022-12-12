<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Vehicle $model */

$this->title = 'Editar Veículo: ' . $model->getBrandNameById() . '('.$model->getModelNameById() .')';
$this->params['breadcrumbs'][] = ['label' => 'Vehicles', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="vehicle-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'brands' => $brands,
        'vehicles_models' =>$vehicle_models
    ]) ?>

</div>
