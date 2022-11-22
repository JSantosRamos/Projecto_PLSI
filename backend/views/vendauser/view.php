<?php

use common\models\Vendauser;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\Vendauser $model */

$this->title = 'Proposta de venda: #' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Vendausers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="vendauser-view">

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
            [
                'attribute' => 'Utilizador',
                'format' =>['html'],
                'value' => function ($model) {
                    return Html::a($model->idUser, Url::toRoute(['user/view', 'id' => $model->idUser]) ,[
                    ]);
                }
            ],
            'brand',
            'model',
            [
                'attribute' => 'serie',
                'value' => $model->serie == null ? 'Sem serie' : $model->serie,
            ],
            'year',
            'fuel',
            'plate',
            [
                'attribute' => 'mileage',
                'value' => $model->mileage . ' km',
            ],
            'price:currency',
            [
                'attribute' => 'description',
                'value' => $model->description == null ? 'Sem extras' : $model->description,
            ],
            'date',
            [
                'attribute' => 'status',
                'format' =>['html'],
                'value' => function ($model) {
                    return Html::tag('span', $model->status ,[
                        'class' => $model->status == Vendauser::POR_VER ? 'badge bg-secondary' : ($model->status == Vendauser::ACEITE ? 'badge bg-success' : ($model->status == Vendauser::RECUSADO ? 'badge bg-danger' : 'badge bg-primary'))
                    ]);
                }
            ],
        ],
    ]) ?>

</div>
