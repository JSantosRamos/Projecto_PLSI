<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Cost $model */

$this->title = $model->title;
?>
<div class="cost-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
