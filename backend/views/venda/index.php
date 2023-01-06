<?php

use common\models\User;
use common\models\Vehicle;
use common\models\Venda;
use yii\bootstrap5\LinkPager;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var common\models\VendaSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Vendas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="venda-index">

    <h1><?= Html::encode($this->title) ?>
        <?= Html::a('<svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-plus-square-fill" viewBox="0 0 16 16">
            <path d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2zm6.5 4.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3a.5.5 0 0 1 1 0z"/>
        </svg>', ['create']) ?>
    </h1>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'summary' => 'Total de Vendas: {totalCount}',
        'emptyText' => 'Não foram encontrados resultados.',
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
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
                    return Html::a(User::getNameById($model->idUser_buyer) . ' (nº' . $model->idUser_buyer . ')', Url::toRoute(['user/view', 'id' => $model->idUser_buyer]), [
                    ]);
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
            'price:currency',
            //'comment',
            [
                'class' => 'yii\grid\ActionColumn', 'template' => User::isAdmin(Yii::$app->user->id) ? '{view} {update} {delete}' : '{view}',
                'urlCreator' => function ($action, Venda $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                }
            ],
        ],
        'pager' => [
            'class' => LinkPager::class
        ]
    ]); ?>

</div>
