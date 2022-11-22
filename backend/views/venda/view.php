<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\Venda $model */

$this->title = 'Venda nº: #' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Vendas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="venda-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Editar', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Apagar', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            [
                'attribute' => 'idUser_seller',
                'format' =>['html'],
                'value' => function ($model) {
                    return Html::a($model->idUser_seller, Url::toRoute(['user/view', 'id' => $model->idUser_seller]) ,[
                    ]);
                }
            ],
            [
                'attribute' => 'idUser_buyer',
                'format' =>['html'],
                'value' => function ($model) {
                    return Html::a($model->idUser_buyer, Url::toRoute(['user/view', 'id' => $model->idUser_buyer]) ,[
                    ]);
                }
            ],
            [
                'attribute' => 'idVehicle',
                'format' =>['html'],
                'value' => function ($model) {
                    return Html::a($model->idVehicle, Url::toRoute(['vehicle/view', 'id' => $model->idVehicle]) ,[
                    ]);
                }
            ],
            'Price:currency',
            'comment',
        ],
    ]) ?>

</div>
