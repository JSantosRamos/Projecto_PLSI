<?php

use common\models\User;
use common\models\Vehicle;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var common\models\VehicleSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Veículos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="vehicle-index">

    <h1><?= Html::encode($this->title) ?></h1>


    <?php if (!User::isEmployee(Yii::$app->user->id)): ?>
        <p>
            <?= Html::a('Adcionar', ['create'], ['class' => 'btn btn-success']) ?>
        </p>
    <?php endif; ?>

    <?php echo $this->render('_search', ['model' => $searchModel, 'brands' => $brands]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'summary' => 'Total de Veículos: {totalCount}',
        'emptyText' => 'Não foram encontrados resultados.',
        'columns' => [
            [
                'attribute' => 'image',
                'content' => function ($model) {
                    return Html::img($model->getImageUrl(), ['style' => 'width: 100px']);
                }
            ],
            'title',
            'plate',
            [
                'attribute' => 'idBrand',
                'value' => function ($model) {
                    return $model->getBrandName();
                }
            ],
            [
                'attribute' => 'idModel',
                'value' => function ($model) {
                    return $model->getModelName();
                }
            ],
            'price:currency',
            [
                'attribute' => 'isActive',
                'content' => function ($model) {
                    return Html::tag('span', $model->isActive ? 'Publicado' : 'Não Publicado', [
                        'class' => $model->isActive ? 'badge bg-success' : 'badge bg-danger'
                    ]);
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
                'class' => ActionColumn::className(),
                'template' => User::isAdmin(Yii::$app->user->id) ? '{view} {update} {delete}' : (User::isManager(Yii::$app->user->id) ? '{view} {update}' : '{view}'),
                'urlCreator' => function ($action, Vehicle $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                }
            ],
        ],
    ]); ?>

</div>
