<?php

use yii\helpers\Html;
use yii\widgets\ListView;

/** @var yii\web\View $this */
/** @var common\models\Venda $model */
/** @var common\models\User $users lista de utilizadores do tipo clientes para a dropdow */
/** @var common\models\Vehicle $vehicles lista de veiculos para a dropdow */
/** @var string $message erro se o veículo que o utilizador está a tentar registar já está vendido, já não acontece por causa da dropdow mas a validação ainda existe */
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

    <?=
    $this->render('_searchlist', [
        'searchVehicle' => $searchVehicle,
        'dataVehicle' => $dataVehicle,
        'dataUser' => $dataUser,
        'searchUser' => $searchUser,
    ]) ?>

</div>


