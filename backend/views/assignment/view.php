<?php

use common\models\User;
use yii\helpers\Html;
use yii\web\YiiAsset;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var backend\models\AuthAssignment $model */

$this->title = $model->item_name;
$this->params['breadcrumbs'][] = ['label' => 'Utilizadores', 'url' => ['user/index']];
$this->params['breadcrumbs'][] = $this->title;
YiiAsset::register($this);
?>
<div class="auth-assignment-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'item_name',
            'user_id',
        ],
    ]) ?>

    <p>
        <?= Html::a('Editar', ['update', 'item_name' => $model->item_name, 'user_id' => $model->user_id], ['class' => 'btn btn-primary']) ?>

        <?php if (User::isAdmin(Yii::$app->user->id)): ?>
            <?= Html::a('Apagar', ['delete', 'item_name' => $model->item_name, 'user_id' => $model->user_id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => 'Tem a certeza que quer apagar?',
                    'method' => 'post',
                ],
            ]) ?>
        <?php endif; ?>

    </p>

</div>
