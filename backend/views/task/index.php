<?php

use common\models\Task;
use common\models\User;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var common\models\TaskSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Lista de Tarefas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="task-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php if (!User::isEmployee(Yii::$app->user->id)): ?>
    <p>
        <?= Html::a('Nova Tarefa', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?php endif; ?>

    <h5>Procurar por:</h5>
    <?php echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'summary' => 'Total de Tarefas: {totalCount}',
        'emptyText' => 'Não foram encontrados resultados.',
        'columns' => [
            'id',
            'type',
            'date',
            [
                'attribute' => 'idAssigned_to',
                'format' => ['html'],
                'value' => function ($model) {
                    return Html::a(User::getNameById($model->idAssigned_to) . ' (nº' . $model->idAssigned_to . ')', Url::toRoute(['user/view', 'id' => $model->idAssigned_to]), [
                    ]);
                }
            ],
            [
                'attribute' => 'status',
                'format' => ['html'],
                'value' => function ($model) {
                    return Html::tag('span', $model->status, [
                        'class' => $model->status == Task::Por_INICIAR ? 'badge bg-secondary' : ($model->status == Task::FINALIZADA ? 'badge bg-success' : 'badge bg-primary')
                    ]);
                }
            ],
            [
                'class' => 'yii\grid\ActionColumn', 'template' => User::isEmployee(\Yii::$app->user->id) ? '{view} {update}' : '{view} {update} {delete}' ,
                'urlCreator' => function ($action, Task $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                }
            ],
        ],
    ]); ?>
</div>

