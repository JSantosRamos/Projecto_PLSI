<?php

use common\models\Task;
use common\models\User;
use yii\bootstrap5\LinkPager;
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

    <h1><?= Html::encode($this->title) ?>
        <?php if (!User::isEmployee(Yii::$app->user->id)): ?>

            <?= Html::a('<svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-plus-square-fill" viewBox="0 0 16 16">
            <path d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2zm6.5 4.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3a.5.5 0 0 1 1 0z"/>
        </svg>', ['create']) ?>

        <?php endif; ?>

    </h1>


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
                'class' => 'yii\grid\ActionColumn', 'template' => User::isEmployee(Yii::$app->user->id) ? '{view} {update}' : '{view} {update} {delete}',
                'urlCreator' => function ($action, Task $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                }
            ],
        ],
        'pager' => [
            'class' => LinkPager::class
        ]
    ]); ?>
</div>

