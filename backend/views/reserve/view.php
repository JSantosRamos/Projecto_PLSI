<?php

use common\models\User;
use common\models\Vehicle;
use yii\helpers\Html;
use yii\web\YiiAsset;
use yii\widgets\DetailView;
use yii\widgets\LinkPager;

/** @var yii\web\View $this */
/** @var common\models\Reserve $model */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Reserves', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
YiiAsset::register($this);
?>
<div class="reserve-view">

    <h1>Reserva: #<?= Html::encode($this->title) ?></h1>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            [
                'attribute' => 'idUser',
                'format' => ['html'],
                'value' => function ($model) {
                    return Html::a(User::getNameById($model->idUser), ['/user/view', 'id' => $model->idUser]);
                }
            ],
            [
                'attribute' => 'idVehicle',
                'format' => ['html'],
                'value' => function ($model) {
                    return Html::a(Vehicle::getPlate($model->idVehicle), ['/vehicle/view', 'id' => $model->idVehicle]);
                }
            ],
            'number',
            'nif',
            'morada',
            [
                'attribute' => 'cc',
                'format' => ['html'],
                'value' => function ($model) {
                    return Html::a($model->fileName($model->cc), ['download', 'file' => $model->cc]);
                }
            ],
            'create_at',
        ],
    ]) ?>

</div>
