<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Image $model */

$this->title = 'Adicionar Imagem';
$this->params['breadcrumbs'][] = ['label' => 'Images', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="image-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'idVehicle' => $idVehicle,
    ]) ?>

</div>
