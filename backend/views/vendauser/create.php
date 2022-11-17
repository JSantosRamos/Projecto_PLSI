<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Vendauser $model */

$this->title = 'Create Vendauser';
$this->params['breadcrumbs'][] = ['label' => 'Vendausers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="vendauser-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
