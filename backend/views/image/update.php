<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Image $model */

$this->title = 'Image: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Images', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="image-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'idVehicle' => $idVehicle,
    ]) ?>

</div>
