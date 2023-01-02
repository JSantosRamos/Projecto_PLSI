<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\User $model */

$this->title = $model->name;
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="user-view">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>




