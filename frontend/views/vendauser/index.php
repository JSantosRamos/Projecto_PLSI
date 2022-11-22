<?php

use common\models\Vendauser;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var common\models\VendauserSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Propostas de venda';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="vendauser-index">

    <h3><?= Html::encode($this->title) ?></h3>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            'plate',
            'brand',
            'model',
            'price:currency',
            [
                'attribute' => 'status',
                'format' =>['html'],
                'value' => function ($model) {
                    return Html::tag('span', $model->status ,[
                        'class' => $model->status == Vendauser::POR_VER ? 'badge bg-secondary' : ($model->status == Vendauser::ACEITE ? 'badge bg-success' : ($model->status == Vendauser::RECUSADO ? 'badge bg-danger' : 'badge bg-primary'))
                    ]);
                }
            ],
            [
                'class' => ActionColumn::className(),
                'template' => '{view}',
                'urlCreator' => function ($action, Vendauser $model, $key, $index, $column) {
                    return Url::toRoute(['vendauser/view', 'id' => $model->id]);
                }
            ],
        ],
    ]); ?>


</div>
