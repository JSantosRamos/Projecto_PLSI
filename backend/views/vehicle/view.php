<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\Vehicle $model */

$this->title = 'Editar Veículo: ' . $model->brand . '('.$model->plate .')';
$this->params['breadcrumbs'][] = ['label' => 'Vehicles', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="vehicle-view">

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
            'title',
            'description:html',
            'plate',
            'brand',
            'model',
            [
                'attribute' => 'serie',
                'value' => $model->serie == null ? 'Sem Informação' : $model->serie,
            ],
            'type',
            'fuel',
            [
                'attribute' => 'mileage',
                'value' => $model->mileage . ' km',
            ],
            'engine',
            'color',
            'year',
            'doorNumber',
            'transmission',
            'price:currency',
            [
                'attribute' => 'image',
                'format' => ['html'],
                'value' => function ($model) {
                    return Html::img($model->getImageUrl(), ['style' => 'width: 100px']);
                }
            ],
            [
                'attribute' => 'isActive',
                'format' =>['html'],
                'value' => function ($model) {
                    return Html::tag('span', $model->isActive ? 'Publicado' : 'Não Publicado',[
                        'class' => $model->isActive ? 'badge bg-success' : 'badge bg-danger'
                    ]);
                }
            ],
        ],
    ]) ?>

</div>
