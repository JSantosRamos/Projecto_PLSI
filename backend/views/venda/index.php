<?php

use common\models\User;
use common\models\Venda;
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

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Nova Venda', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

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
                    return Html::a(User::getName($model->idUser_seller) . ' (nº' . $model->idUser_seller . ')', Url::toRoute(['user/view', 'id' => $model->idUser_seller]), [
                    ]);
                }
            ],
            [
                'attribute' => 'idUser_buyer',
                'format' => ['html'],
                'value' => function ($model) {
                    return Html::a(User::getName($model->idUser_buyer) . ' (nº' . $model->idUser_buyer . ')', Url::toRoute(['user/view', 'id' => $model->idUser_buyer]), [
                    ]);
                }
            ],
            [
                'attribute' => 'idVehicle',
                'format' => ['html'],
                'value' => function ($model) {
                    return Html::a($model->idVehicle, Url::toRoute(['vehicle/view', 'id' => $model->idVehicle]), [
                    ]);
                }
            ],
            'Price:currency',
            //'comment',
            [
                'class' => 'yii\grid\ActionColumn', 'template' => User::isAdmin(\Yii::$app->user->id) ? '{view} {update} {delete}' : '{view} {update}' ,
                'urlCreator' => function ($action, Venda $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>

</div>
