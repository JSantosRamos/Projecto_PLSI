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
<?= common\widgets\Alert::widget() ?>
<div class="vehicle-index">

    <h1><?= Html::encode($this->title) ?>
        <?php if (!User::isEmployee(Yii::$app->user->id)): ?>
            <?= Html::a('<svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-plus-square-fill" viewBox="0 0 16 16">
            <path d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2zm6.5 4.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3a.5.5 0 0 1 1 0z"/>
        </svg>', ['create']) ?>
        <?php endif; ?>
    </h1>


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
