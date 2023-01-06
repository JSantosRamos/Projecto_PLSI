<?php

use common\models\User;
use yii\bootstrap5\LinkPager;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use backend\models\AuthAssignment;
use yii\widgets\Pjax;

/** @var yii\web\View $this */
/** @var common\models\UserSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */
/** @var backend\models\AuthAssignmentSearch $searchModelAssign */

$this->title = 'Utilizadores';
$this->params['breadcrumbs'][] = $this->title;

$role = User::getRoleName(Yii::$app->user->id);

$this->registerJs('$("document").ready(function(){
		$("#filter_users").on("pjax:end", function() {
			$.pjax.reload({container:"#listusers"});  //Reload GridView
		});
    });'
);

$this->registerJs('$("document").ready(function(){
		$("#filter_permissons").on("pjax:end", function() {
			$.pjax.reload({container:"#listpermissions"});  //Reload GridView
		});
    });'
);

?>
<div class="user-index">

    <h1><?= Html::encode($this->title) ?>

        <?php if ($role == 'admin' || $role == 'manager'): ?>
            <?= Html::a('<svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-plus-square-fill" viewBox="0 0 16 16">
            <path d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2zm6.5 4.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3a.5.5 0 0 1 1 0z"/>
        </svg>', ['create']) ?>
        <?php endif; ?>
    </h1>


    <br>
    <?php echo $this->render('_search', ['model' => $searchModel]); ?>

    <?php Pjax::begin(['id' => 'listusers']) ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'summary' => 'Total de Utilizadores: {totalCount}',
        'emptyText' => 'Não foram encontrados resultados.',
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'id',
            'name',
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
                'headerOptions' => ['style' => 'width:5%'],
                'template' => $role == 'admin' ? '{view} {update} {delete}' : '{view}',
                'urlCreator' => function ($action, User $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                }
            ],
        ],
        'pager' => [
            'class' => LinkPager::class
        ]
    ]); ?>
    <?php Pjax::end() ?>
</div>
<br>

<h2>Gerir Permissões de Utilizadores</h2>

<?php echo $this->render('/assignment/_search', ['modelPermissons' => $userPermissonsSearch]); ?>

<?php Pjax::begin(['id' => 'listpermissions']) ?>
<?= GridView::widget([
    'dataProvider' => $userPermissons,
    'summary' => '',
    'emptyText' => 'Não foram encontrados resultados.',
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],
        [
            'attribute' => 'user_id',
            'format' => ['html'],
            'value' => function ($model) {
                return Html::a(User::getNameById($model->user_id) . ' (nº:' . $model->user_id . ')', Url::toRoute(['user/view', 'id' => $model->user_id]), [
                ]);
            }
        ],
        'item_name',
        [
            'class' => ActionColumn::className(),
            'headerOptions' => ['style' => 'width:5%'],
            'template' => '{view}',
            'urlCreator' => function ($action, AuthAssignment $modelAuth, $key, $index, $column) {
                return Yii::$app->urlManager->createUrl(['assignment/view', 'item_name' => $modelAuth->item_name, 'user_id' => $modelAuth->user_id]);
            }
        ],
    ],
    'pager' => [
        'class' => LinkPager::class
    ]
]); ?>
<?php Pjax::end() ?>




