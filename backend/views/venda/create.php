<?php

use yii\helpers\Html;
use yii\widgets\ListView;

/** @var yii\web\View $this */
/** @var common\models\Venda $model */
/** @var common\models\VehicleSearch $searchVehicle */

$this->title = 'Registo de Venda';
$this->params['breadcrumbs'][] = ['label' => 'Vendas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="venda-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

<div class="venda-searchlist">

    <?= $this->render('searchlist', [
        'searchVehicle' => $searchVehicle,
        'dataVehicle' => $dataVehicle,
        'dataUser' => $dataUser,
        'searchUser' => $searchUser,
    ]) ?>
</div>
