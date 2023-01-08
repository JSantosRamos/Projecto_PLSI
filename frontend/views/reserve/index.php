<?php

use common\models\Reserve;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var common\models\ReserveSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Reserves';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="reserve-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Reserve', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'idUser',
            'idVehicle',
            'number',
            'nif',
            //'morada',
            //'cc:ntext',
            //'create_at',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Reserve $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
