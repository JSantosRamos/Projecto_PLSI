<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Reserve $model */

$this->title = 'Update Reserve: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Reserves', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="reserve-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
