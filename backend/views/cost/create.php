<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Cost $model */

$this->title = 'Create Cost';
$this->params['breadcrumbs'][] = ['label' => 'Costs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cost-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
