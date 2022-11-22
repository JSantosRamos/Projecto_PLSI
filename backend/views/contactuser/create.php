<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Contactuser $model */

$this->title = 'Create Contactuser';
$this->params['breadcrumbs'][] = ['label' => 'Contactusers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="contactuser-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
