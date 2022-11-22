<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Contactuser $model */

$this->title = 'Update Contactuser: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Contactusers', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="contactuser-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
