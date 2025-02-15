<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Venda $model */

$this->title = 'Venda: #' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Vendas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="venda-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'users' => $users,
        'vehicles' => $vehicles,
        'message' => $message,
    ]) ?>

</div>
