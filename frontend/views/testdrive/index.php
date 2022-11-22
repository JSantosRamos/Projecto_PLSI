<?php

use common\models\Testdrive;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var common\models\TestdriveSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Testdrives';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="testdrive-index">

    <h3><?= Html::encode($this->title) ?></h3>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'idVehicle',
                'format' =>['html'],
                'value' => function ($model) {
                    return Html::a($model->idVehicle, Url::toRoute(['vehicle/view', 'id' => $model->idVehicle]) ,[
                    ]);
                }
            ],
            'date',
            'time',
            'description',
            [
                'attribute' => 'status',
                'format' =>['html'],
                'value' => function ($model) {
                    return Html::tag('span', $model->status ,[
                        'class' => $model->status == 'Por ver' ? 'badge bg-secondary' : ($model->status == 'Aceite' ? 'badge bg-success' : 'badge bg-danger')
                    ]);
                }
            ],
            [
                'class' => ActionColumn::className(),
                'template' => '{view}',
                'urlCreator' => function ($action, $model, $key, $index, $column) {

                    return Url::toRoute(['testdrive/view', 'id' => $model->id]);
                }
            ],

        ],
    ]); ?>
</div>