<?php

use common\models\User;
use yii\helpers\Html;
use yii\web\YiiAsset;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\User $model */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
YiiAsset::register($this);
common\widgets\Alert::widget()
?>
<div class="user-view">

    <?php if (isset($_GET['erro_delete'])) {
        echo '<div class="alert alert-danger" role="alert">Não é possível apagar este utilizador.</div>';
    }
    ?>

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?php
        $id = Yii::$app->user->id;
        if (User::isAdmin($id)): ?>
            <?= Html::a('Editar', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']); ?>
            <?= Html::a('Apagar', ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => 'Têm a certeza que quer apagar este utilizador?',
                    'method' => 'post',
                ],
            ]); ?>

        <?php elseif (User::isManager($id) && !User::isAdmin($model->id)): ?>
            <?= Html::a('Editar', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?php endif; ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
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
        ],
    ]) ?>

</div>
