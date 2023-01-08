<?php

use common\models\Testdrive;
use common\models\User;
use common\models\Vehicle;
use yii\bootstrap5\LinkPager;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var common\models\TestdriveSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Test-Drives';
$this->params['breadcrumbs'][] = $this->title;
$role = User::getRoleName(Yii::$app->user->id);
?>
<div class="testdrive-index">

    <h1><?= Html::encode($this->title) ?>
        <?php if (!User::isEmployee(Yii::$app->user->id)): ?>
            <?= Html::a('<svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-plus-square-fill" viewBox="0 0 16 16">
            <path d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2zm6.5 4.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3a.5.5 0 0 1 1 0z"/>
        </svg>', ['create']) ?>
        <?php endif; ?>
    </h1>

    <p>Procurar por:</p>
    <?php echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'summary' => 'Total de Test-Drives: {totalCount}',
        'emptyText' => 'Não foram encontrados resultados.',
        'columns' => [
            'id',
            [
                'attribute' => 'idVehicle',
                'format' => ['html'],
                'value' => function ($model) {
                    return Html::a(Vehicle::getPlate($model->idVehicle) . '(' . $model->idVehicle . ')', Url::toRoute(['vehicle/view', 'id' => $model->idVehicle]), [
                    ]);
                }
            ],
            [
                'attribute' => 'idUser',
                'format' => ['html'],
                'value' => function ($model) {
                    return Html::a(User::getNameById($model->idUser) . " (nº" . $model->idUser . ")", Url::toRoute(['user/view', 'id' => $model->idUser]), [
                    ]);
                }
            ],
            'date',
            'time',
            'description',
            [
                'attribute' => 'status',
                'format' => ['html'],
                'value' => function ($model) {
                    return Html::tag('span', $model->status, [
                        'class' => $model->status == Testdrive::POR_VER ? 'badge bg-secondary' : ($model->status == Testdrive::ACEITE ? 'badge bg-success' : ($model->status == Testdrive::RECUSADO ? 'badge bg-danger' : 'badge bg-info'))
                    ]);
                }
            ],
            [
                'class' => 'yii\grid\ActionColumn', 'template' => $role == 'employee' ? '{view}':'{view} {update} {delete}',
                'urlCreator' => function ($action, Testdrive $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                }
            ],
        ],
        'pager' => [
            'class' => LinkPager::class
        ],
    ]); ?>


</div>
