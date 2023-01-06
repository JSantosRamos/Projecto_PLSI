<?php

use common\models\Image;
use common\models\User;
use common\models\Vehicle;
use yii\bootstrap5\LinkPager;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\YiiAsset;
use yii\widgets\DetailView;
use yii\widgets\Pjax;

/** @var yii\web\View $this */
/** @var common\models\Vehicle $model */

$this->title = 'Editar Veículo: (' . $model->plate . ')';
$this->params['breadcrumbs'][] = ['label' => 'Vehicles', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
YiiAsset::register($this);
?>
<div class="vehicle-view">

    <?php if (isset($_GET['erro_delete'])) {
        echo '<div class="alert alert-danger" role="alert">Não é possível apagar este veículo.</div>';
    }
    ?>

    <h1><?= Html::encode($this->title) ?></h1>

    <?php if (!User::isEmployee(Yii::$app->user->id)): ?>
        <p>
            <?= Html::a('Editar', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
            <?php if (User::isAdmin(Yii::$app->user->getId())) {
                Html::a('Apagar', ['delete', 'id' => $model->id], [
                    'class' => 'btn btn-danger',
                    'data' => [
                        'confirm' => 'Tem a certeza que quer apagar?',
                        'method' => 'post',
                    ],
                ]);
            } ?>
        </p>
    <?php endif; ?>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'title',
            'description:html',
            'plate',
            [
                'attribute' => 'idBrand',
                'value' => $model->getBrandName(),
            ],
            [
                'attribute' => 'idModel',
                'value' => $model->getModelName(),
            ],
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
                'attribute' => 'status',
                'format' => ['html'],
                'value' => function ($model) {
                    return Html::tag('span', $model->status, [
                        'class' => $model->status == Vehicle::STATUS_AVAILABLE ? 'badge bg-primary' : ($model->status == Vehicle::STATUS_RESERVED ? 'badge bg-warning' : 'badge bg-success')
                    ]);
                }
            ],
            [
                'attribute' => 'isActive',
                'format' => ['html'],
                'value' => function ($model) {
                    return Html::tag('span', $model->isActive ? 'Publicado' : 'Não Publicado', [
                        'class' => $model->isActive ? 'badge bg-success' : 'badge bg-danger'
                    ]);
                }
            ],
        ],
    ]) ?>

    <br>
    <h2>Imagens <?= Html::a('<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-plus-square-fill" viewBox="0 0 16 16">
  <path d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2zm6.5 4.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3a.5.5 0 0 1 1 0z"/>
</svg>', ['/image/create', 'id_vehicle' => $model->id]) ?></h2>


    <?php Pjax::begin(['id' => 'listimagens']) ?>
    <?= GridView::widget([
        'dataProvider' => $imagens,
        'summary' => 'Total de Imagens: {totalCount}',
        'emptyText' => '',
        'columns' => [
            [
                'class' => ActionColumn::className(),
                'headerOptions' => ['style' => 'width:5%'],
                'template' => '{delete}',
                'buttons' => [
                    'delete' => function ($url, Image $modelImage) {
                        return Html::a('<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16"><path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5Zm-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5ZM4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5Z"/></svg>',
                            [$url, 'id' => $modelImage->id], [
                                'class' => '',
                                'data' => [
                                    'confirm' => 'Tem a certeza que quer apagar?',
                                    'method' => 'post',
                                ],
                            ]);
                    }
                ],

                'urlCreator' => function ($action, Image $modelImage, $key, $index, $column) {
                    return Url::toRoute(['/image/' . $action, 'id' => $modelImage->id]);
                }
            ],
            [
                'attribute' => 'path',
                'format' => ['html'],
                'value' => function ($model) {
                    return Html::img($model->getImageUrl(), ['style' => 'width: 200px']);
                }
            ],

        ],
        'pager' => [
            'class' => LinkPager::class
        ]
    ]); ?>
    <?php Pjax::end() ?>

</div>
