<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\Reserve $model */

$this->title = 'Reserva';
$this->params['breadcrumbs'][] = ['label' => 'Área Pessoal', 'url' => ['site/areapessoal']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="reserve-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
                'attribute' => 'idVehicle',
                'format' => ['html'],
                'value' => function ($model) {
                    return Html::a($model->idVehicle, Url::toRoute(['/vehicle/view', 'id' => $model->idVehicle]), [
                    ]);
                }
            ],
            'number',
            'nif',
            'morada',
            [
                'attribute' => 'cc',
                'format' => ['html'],
                'value' => function ($model) {
                    return Html::a($model->fileName($model->cc), ['download','file' => $model->cc]);
                }
            ],
            'create_at',
        ],
    ]) ?>

</div>
