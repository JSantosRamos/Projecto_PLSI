<?php

use common\models\Note;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\ListView;

/** @var yii\web\View $this */
/** @var common\models\NoteSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Notes';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="note-index">

    <h5>Notas da Tarefa</h5>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            'description',
            'idUser',
            // 'idTask',
            'create_at',
            [
                'class' => ActionColumn::className(),
                'template' => '{update}',
                'urlCreator' => function ($action, Note $model, $key, $index, $column) {
                    return Url::toRoute(['note/update', 'id' => $model->id]);
                }
            ],
        ],
    ]);
    ?>


</div>
