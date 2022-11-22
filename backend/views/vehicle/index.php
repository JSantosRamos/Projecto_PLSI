<?php

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

    <p>
        <?= Html::a('Adcionar', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php  echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            [
                'attribute' => 'image',
                'content' => function ($model) {
                    return Html::img($model->getImageUrl(), ['style' => 'width: 100px']);
                }
            ],
            'title',
            'plate',
            'brand',
            'model',
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
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Vehicle $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                }
            ],
        ],
    ]); ?>

</div>
