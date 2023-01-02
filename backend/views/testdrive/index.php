<?php

use common\models\Testdrive;
use common\models\User;
use common\models\Vehicle;
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

    <h1><?= Html::encode($this->title) ?></h1>

    <?php if (!User::isEmployee(Yii::$app->user->id)): ?>
        <p>
            <?= Html::a('Criar novo', ['create'], ['class' => 'btn btn-success']) ?>
        </p>
    <?php endif; ?>

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
                    return Html::a(Vehicle::getPlate($model->idVehicle) . '(' .$model->idVehicle . ')', Url::toRoute(['vehicle/view', 'id' => $model->idVehicle]), [
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
                'class' => 'yii\grid\ActionColumn', 'template' => $role == 'admin' ? '{view} {update} {delete}' : ($role == 'manager' ? '{view} {update}' : '{view}'),
                'urlCreator' => function ($action, Testdrive $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                }
            ],
        ],
    ]); ?>


</div>
