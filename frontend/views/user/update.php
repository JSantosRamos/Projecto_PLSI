<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\User $model */
?>

<div class="user-update">

    <h3><?= Html::encode($this->title) ?></h3>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
