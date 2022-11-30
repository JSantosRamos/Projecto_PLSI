<?php

use common\models\User;
use common\models\Vendauser;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var common\models\VendauserSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Propostas de Compra';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="vendauser-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <h5>Procurar por:</h5>
    <?php echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'summary' => 'Total de Propostas: {totalCount}',
        'emptyText' => 'Não foram encontrados resultados.',
        'columns' => [
            'brand',
            'model',
            'serie',
            'year',
            'mileage',
            'price:currency',
            [
                'attribute' => 'status',
                'format' =>['html'],
                'value' => function ($model) {
                    return Html::tag('span', $model->status ,[
                        'class' => $model->status == Vendauser::POR_VER ? 'badge bg-secondary' : ($model->status == Vendauser::ACEITE ? 'badge bg-success' : ($model->status == Vendauser::RECUSADO ? 'badge bg-danger' :
                            ($model->status == Vendauser::EM_ANALISE ? 'badge bg-primary' : 'badge bg-info')))
                    ]);
                }
            ],
            [
                'class' => 'yii\grid\ActionColumn', 'template' => User::isAdmin(\Yii::$app->user->id) ? '{view} {update} {delete}' : '{view} {update}' ,
                'urlCreator' => function ($action, Vendauser $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                }
            ],
        ],
    ]); ?>


</div>
