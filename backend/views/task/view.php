<?php

use common\models\Note;
use common\models\Task;
use common\models\User;
use yii\bootstrap5\LinkPager;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;
use yii\widgets\ListView;

/** @var yii\web\View $this */
/** @var common\models\Task $model */

$this->title = 'Tarefa: #' . $model->id . ' (' . $model->type . ')';
\yii\web\YiiAsset::register($this);
?>
<div class="task-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'type',
            'description',
            'date',
            [
                'attribute' => 'idAssigned_to',
                'format' => ['html'],
                'value' => function ($model) {
                    return Html::a(User::getNameById($model->idAssigned_to) . ' (nº' . $model->idAssigned_to . ')', Url::toRoute(['user/view', 'id' => $model->idAssigned_to]));
                }
            ],
            [
                'attribute' => 'idCreated_by',
                'format' => ['html'],
                'value' => function ($model) {
                    return Html::a(User::getNameById($model->idCreated_by) . ' (nº' . $model->idCreated_by . ')', Url::toRoute(['user/view', 'id' => $model->idCreated_by]));
                }
            ],
            'created_at',
            [
                'attribute' => 'status',
                'format' => ['html'],
                'value' => function ($model) {
                    return Html::tag('span', $model->status, [
                        'class' => $model->status == Task::Por_INICIAR ? 'badge bg-secondary' : ($model->status == Task::FINALIZADA ? 'badge bg-success' : 'badge bg-primary')
                    ]);
                }
            ],
        ],
    ]) ?>

    <p>
        <?= Html::a('Editar', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>

        <?php if (!User::isEmployee(Yii::$app->user->id)): ?>
            <?= Html::a('Apagar', ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => 'Tem a certeza que quer apagar?',
                    'method' => 'post',
                ],
            ]); ?>
        <?php endif; ?>
        <?= Html::a('Adicionar Nota', Url::toRoute(['note/create', 'idTask' => $model->id]), ['class' => 'btn btn-success']) ?>
    </p>

</div>

<br>

<div class="notes">
    <h2>Notas:</h2>
    <hr style="border: 1px solid blue">
    <?= ListView::widget([
        'dataProvider' => $notes,
        'itemView' => '/note/_item',
        'summary' => '',
        'emptyText' => 'Não foram encontrados resultados.',
        'pager' => [
            'class' => LinkPager::class
        ]
    ]) ?>
</div>


