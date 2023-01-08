<?php

use common\models\Reserve;
use common\models\User;
use yii\bootstrap5\LinkPager;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var common\models\ReserveSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Reservas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="reserve-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'summary' => '',
        'emptyText' => 'Não foram encontrados resultados.',
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

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
                    return Html::a(\common\models\Vehicle::getPlate($model->idVehicle), ['/vehicle/view', 'id' => $model->idVehicle]);
                }
            ],
            'number',
            'nif',
            //'morada',
            [
                'attribute' => 'cc',
                'format' => ['html'],
                'value' => function ($model) {
                    return Html::a($model->fileName($model->cc), ['download', 'file' => $model->cc]);
                }
            ],
            'create_at',
            [
                'class' => ActionColumn::className(),
                'template' => User::isEmployee(Yii::$app->user->id) ? '{view}' : '{view} {delete}',
                'urlCreator' => function ($action, Reserve $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                }
            ],
        ],
        'pager' => [
            'class' => LinkPager::class
        ]
    ]); ?>


</div>
