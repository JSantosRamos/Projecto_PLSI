<?php

use common\models\User;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use backend\models\AuthAssignment;

/** @var yii\web\View $this */
/** @var common\models\UserSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */
/** @var backend\models\AuthAssignmentSearch $searchModelAssign */

$this->title = 'Utilizadores';
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="user-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Adicionar', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'summary' => 'Total de Utilizadores: {totalCount}',
        'emptyText' => 'Não foram encontrados resultados.',
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            'username',
            'email:email',
            [
                'attribute' => 'status',
                'format' => ['html'],
                'value' => function ($model) {
                    return Html::tag('span', $model->status == 10 ? 'Ativo' : 'Desativo', [
                        'class' => $model->status == 10 ? 'badge bg-success' : 'badge bg-danger'
                    ]);
                }
            ],
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, User $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                }
            ],
        ],
    ]); ?>

</div>
<br>

<?php if ($searchModelAssignment != null && $dataProviderAssignment != null) : ?>

    <div class="user-index">

        <h2>Gerir Permissões de Utilizadores</h2>

        <?= GridView::widget([
            'dataProvider' => $dataProviderAssignment,
            'summary' => '',
            'emptyText' => 'Não foram encontrados resultados.',
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                [
                    'attribute' => 'user_id',
                    'format' => ['html'],
                    'value' => function ($model) {
                        return Html::a(User::getName($model->user_id) .' (nº:'. $model->user_id.')', Url::toRoute(['user/view', 'id' => $model->user_id]), [
                        ]);
                    }
                ],
                'item_name',
                [
                    'class' => ActionColumn::className(),
                    'template' => '{view}',
                    'urlCreator' => function ($action, AuthAssignment $modelAuth, $key, $index, $column) {
                        return Yii::$app->urlManager->createUrl(['assignment/view', 'item_name' => $modelAuth->item_name, 'user_id' => $modelAuth->user_id]);
                    }
                ],
            ],
        ]); ?>
    </div>
<?php endif; ?>



