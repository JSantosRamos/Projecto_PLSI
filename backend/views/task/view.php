<?php

use common\models\Note;
use common\models\Task;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;

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
            'idAssigned_to',
            'idCreated_by',
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
        <?= Html::a('Apagar', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>

        <?= Html::a('Adicionar Nota', Url::toRoute(['note/create', 'idTask' => $model->id]), ['class' => 'btn btn-success']) ?>
    </p>

</div>

<br>

<div class="note-index">

    <h5>Notas:</h5>

    <?php foreach ($notes as $note): ?>
        <p><?= $note->description; ?>
            <br><span>Criado por: <?= $note->idUser; ?> a <?= $note->create_at; ?> </span>
        </p>

        <?= Html::a('Editar', Url::toRoute(['note/update', 'id' => $note->id]), ['class' => 'text']) ?>
        <?= Html::a('Apagar', Url::toRoute(['note/delete', 'id' => $note->id]), [
        'class' => 'text',
        'data' => [
            'confirm' => 'Are you sure you want to delete this item?',
            'method' => 'post',
        ],
    ]) ?>
        <hr style="border: 1px solid blue">
    <?php endforeach; ?>

</div>


<div class="note-index">

    <?php /* $this->render('/note/index', [
        'dataProvider' => $notes,
    ]) */ ?>

</div>
