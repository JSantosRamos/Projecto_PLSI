<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Vendauser $model */

$this->title = 'Proposta de Venda';
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="vendauser-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'brands' => $brands,
        'vehicles_models' => "",
    ]) ?>

</div>
