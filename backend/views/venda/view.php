<?php

use common\models\User;
use common\models\Vehicle;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\YiiAsset;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\Venda $model */

$this->title = 'Venda nº: #' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Vendas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
YiiAsset::register($this);
?>
<div class="venda-view">

    <h1><?= Html::encode($this->title) ?></h1>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            [
                'attribute' => 'idUser_seller',
                'format' => ['html'],
                'value' => function ($model) {
                    return Html::a(User::getNameById($model->idUser_seller) . ' (nº' . $model->idUser_seller . ')', Url::toRoute(['user/view', 'id' => $model->idUser_seller]), [
                    ]);
                }
            ],
            [
                'attribute' => 'idUser_buyer',
                'format' => ['html'],
                'value' => function ($model) {
                    if ($model->idUser_buyer == null) {
                        return 'Sem conta';
                    } else {
                        return Html::a(User::getNameById($model->idUser_buyer) . ' (nº' . $model->idUser_buyer . ')', Url::toRoute(['user/view', 'id' => $model->idUser_buyer]), [
                        ]);
                    }
                }
            ],
            [
                'attribute' => 'idVehicle',
                'format' => ['html'],
                'value' => function ($model) {
                    return Html::a(Vehicle::getPlate($model->idVehicle), Url::toRoute(['vehicle/view', 'id' => $model->idVehicle]), [
                    ]);
                }
            ],
            'name',
            'nif',
            'number',
            'address',
            'price:currency',
        ],
    ]) ?>
    <p>
        <?php
        if (User::isAdmin(Yii::$app->user->id)): ?>
            <?= Html::a('Editar', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
            <?= Html::a('Apagar', ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => 'Tem a certeza que quer apagar?',
                    'method' => 'post',
                ],
            ])
            ?>
        <?php endif; ?>

        <?= Html::a('Detalhes', ['viewdetail', 'id' => $model->id], ['class' => 'btn btn-primary']); ?>
    </p>

</div>
