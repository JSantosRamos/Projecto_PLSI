<?php

use common\models\Vendauser;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\ListView;

/** @var yii\web\View $this */
/** @var common\models\VendauserSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Propostas de venda';
?>
<div class="vendauser-index">

    <h3><?= Html::encode($this->title) ?></h3>

    <?php if ($dataProvider->count > 0): ?>
    <div class="table-responsive">
        <table class="table table-striped custom-table">
            <thead>
            <tr>
                <th scope="col"></th>
                <th scope="col">Matricula</th>
                <th scope="col">Marca</th>
                <th scope="col">Modelo</th>
                <th scope="col">Valor</th>
                <th scope="col">Status</th>
            </tr>
            </thead>
            <tbody>
            <tr class="">
                <?= ListView::widget([
                    'dataProvider' => $dataProvider,
                    'layout' => '{items}',
                    'itemView' => '_item',
                    'itemOptions' => ['class' => 'col mb-5']
                ]) ?>
            </tr>
            </tbody>
        </table>
    </div>

    <?php else: echo 'Não tem propostas de venda.'?>
    <?php endif; ?>
</div>

