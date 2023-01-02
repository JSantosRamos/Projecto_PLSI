<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Testdrive $model */

$this->title = 'Novo';
$this->params['breadcrumbs'][] = ['label' => 'Testdrives', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="testdrive-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'dateInvalidMessage' => $dateInvalidMessage,
        'vehicles' => $vehicles,
        'users' => $users,

    ]) ?>

</div>
