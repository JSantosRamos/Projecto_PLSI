<?php

use common\models\Brand;
use common\models\Model;
use common\models\User;
use common\models\Vehicle;
use common\models\Vendauser;
use yii\bootstrap5\LinkPager;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\YiiAsset;
use yii\widgets\DetailView;
use yii\widgets\ListView;

/** @var yii\web\View $this */
/** @var common\models\Vendauser $model */

$this->title = 'Proposta de venda: #' . $model->id;
YiiAsset::register($this);
?>
<div class="vendauser-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
                'attribute' => 'idUser',
                'format' => ['html'],
                'value' => function ($model) {
                    return Html::a(User::getNameById($model->idUser), Url::toRoute(['user/view', 'id' => $model->idUser]), [
                    ]);
                }
            ],
            [
                'attribute' => 'brand',
                'value' => function ($model) {return Brand::getNameById($model->brand);}
            ],
            [
                'attribute' => 'model',
                'value' => function ($model) {return Model::getNameById($model->model);}
            ],
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
                'format' => ['html'],
                'value' => function ($model) {
                    return Html::tag('span', $model->status, [
                        'class' => $model->status == Vendauser::POR_VER ? 'badge bg-secondary' : ($model->status == Vendauser::ACEITE ? 'badge bg-success' : ($model->status == Vendauser::RECUSADO ? 'badge bg-danger' :
                            ($model->status == Vendauser::EM_ANALISE ? 'badge bg-primary' : 'badge bg-info')))
                    ]);
                }
            ],
        ],
    ]) ?>

</div>
<p>
    <?= Html::a('Editar', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
    <?php
    if (User::isAdmin(Yii::$app->user->id)) {
        Html::a('Apagar', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]);
    }
    ?>
    <?= Html::a('Adicionar Nota', Url::toRoute(['note/create', 'idVenda' => $model->id]), ['class' => 'btn btn-success']) ?>
</p>
<br>
<div class="notes">
    <h2>Notas:</h2>
    <hr style="border: 1px solid blue">
    <?= ListView::widget([
        'dataProvider' => $dataProviderNote,
        'summary' => '',
        'emptyText' => 'Não foram encontrados resultados.',
        'itemView' => '/note/_item',
        'pager' => [
            'class' => LinkPager::class
        ]
    ]) ?>
</div>

