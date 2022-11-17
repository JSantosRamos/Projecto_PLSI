<?php

use common\models\Testdrive;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url; ?>

<div class="testdrive-index">

    <h3>Teste-Drive</h3>

    <?= GridView::widget([
        'dataProvider' => $dataProviderTestdrive,
        'filterModel' => $searchModelTestdrive,
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

<div class="vendauser-index">

    <?= $this->render('/vendauser/index', [
        'dataProvider' => $dataProviderVendauser,
        'searchModel' => $searchModelVendauser,
    ]) ?>
</div>
