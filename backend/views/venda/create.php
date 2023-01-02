<?php

use yii\helpers\Html;
use yii\widgets\ListView;

/** @var yii\web\View $this */
/** @var common\models\Venda $model */
/** @var common\models\VehicleSearch $searchVehicle */
/** @var yii\data\ActiveDataProvider $dataVehicle vehicle */

/** @var common\models\UserSearch $searchUser */
/** @var yii\data\ActiveDataProvider $dataUser user */


$this->title = 'Registar Venda';
$this->params['breadcrumbs'][] = ['label' => 'Vendas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="venda-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'message' => $message,
        'users' => $users,
        'vehicles' => $vehicles,
    ]) ?>
    <br>
    <hr style="border: 1px solid blue">
    <br>
    <?= $this->render('_searchlist', [
        'searchVehicle' => $searchVehicle,
        'dataVehicle' => $dataVehicle,
        'dataUser' => $dataUser,
        'searchUser' => $searchUser,
    ]) ?>
</div>


