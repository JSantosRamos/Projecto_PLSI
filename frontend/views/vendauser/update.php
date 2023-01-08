<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Vendauser $model */

$this->title = 'Proposta de Venda:';
$this->params['breadcrumbs'][] = ['label' => $model->plate, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Editar';
?>
<div class="vendauser-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'vBrands' => $vBrands,
        'vModels' => $vModels,
    ]) ?>

</div>
