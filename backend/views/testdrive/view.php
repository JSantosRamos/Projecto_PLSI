<?php

use common\models\Testdrive;
use common\models\User;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\Testdrive $model */

$this->title = 'Marcação de Teste-drive: #' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Testdrives', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);

$role = User::getRoleName(\Yii::$app->user->id);
?>
<div class="testdrive-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
                'attribute' => 'idVehicle',
                'format' => ['html'],
                'value' => function ($model) {
                    return Html::a($model->idVehicle, Url::toRoute(['vehicle/view', 'id' => $model->idVehicle]), [
                    ]);
                }
            ],
            [
                'attribute' => 'idUser',
                'format' => ['html'],
                'value' => function ($model) {
                    return Html::a(User::getNameById($model->idUser), Url::toRoute(['user/view', 'id' => $model->idUser]), [
                    ]);
                }
            ],
            'date',
            'time',
            'description',
            [
                'attribute' => 'status',
                'format' => ['html'],
                'value' => function ($model) {
                    return Html::tag('span', $model->status, [
                        'class' => $model->status == Testdrive::POR_VER ? 'badge bg-secondary' : ($model->status == Testdrive::ACEITE ? 'badge bg-success' : ($model->status == Testdrive::RECUSADO ? 'badge bg-danger' : 'badge bg-info'))
                    ]);
                }
            ],
        ],
    ]) ?>

    <p>
        <?php if ($role == 'manager'): ?>

            <?= Html::a('Editar', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>

        <?php elseif ($role == 'admin'): ?>
            <?= Html::a('Editar', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
            <?= Html::a('Apagar', ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => 'Are you sure you want to delete this item?',
                    'method' => 'post',
                ],
            ]);
            ?>

        <?php endif; ?>
    </p>

</div>
