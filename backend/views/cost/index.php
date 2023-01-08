<?php

use common\models\Cost;
use common\models\User;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\CostSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Despesas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cost-index">

    <h1><?= Html::encode($this->title) ?>
        <?= Html::a('<svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-plus-square-fill" viewBox="0 0 16 16">
            <path d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2zm6.5 4.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3a.5.5 0 0 1 1 0z"/>
        </svg>', ['create']) ?>
    </h1>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'summary' => '',
        'emptyText' => 'Não foram encontrados resultados.',
        'columns' => [
            'title',
            'valor:currency',
            [
                'attribute' => 'idUser',
                'format' => ['html'],
                'value' => function ($model) {
                    return Html::a(User::getNameById($model->idUser), ['/user/view', 'id' => $model->idUser]);
                }
            ],
            [
                'attribute' => 'file',
                'format' => ['html'],
                'value' => function ($model) {
                    return Html::a($model->fileName($model->file), ['download', 'file' => $model->file]);
                }
            ],
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Cost $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                }
            ],
        ],
    ]); ?>

</div>
