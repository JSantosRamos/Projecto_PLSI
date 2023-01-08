<?php

use common\models\Testdrive;
use yii\bootstrap5\LinkPager;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ListView;
use yii\widgets\Pjax;

/** @var yii\web\View $this */
$this->title = 'Área Pessoal';
$this->params['breadcrumbs'][] = $this->title;
?>
<?php
/** @var common\models\TestdriveSearch $searchModelTestdrive */
/** @var yii\data\ActiveDataProvider $dataProviderTestdrive */

?>

<div class="row">
    <div class="testdrive-index col-md-4">
        <h3>Teste-Drives</h3>
        <?php if ($dataProviderTestdrive->count > 0): ?>
            <?php Pjax::begin(); ?>
            <?= ListView::widget([
                'dataProvider' => $dataProviderTestdrive,
                'itemOptions' => ['class' => 'col mb-5'],
                'summary' => '',
                'emptyText' => 'Não foram encontrados resultados.',
                'itemView' => '/testdrive/_item',
                'pager' => [
                    'class' => LinkPager::class
                ],
            ]) ?>
            <?php Pjax::end(); ?>
        <?php else: echo 'Não tem test-drives agendados.' ?>
        <?php endif; ?>
    </div>
    <?php
    /** @var common\models\VendauserSearch $searchModelVendauser */
    /** @var yii\data\ActiveDataProvider $dataProviderVendauser */
    ?>

    <div class="vendauser-index col-md-4">

        <h3>Propostas de venda</h3>
        <?php if ($dataProviderVendauser->count > 0): ?>
            <?php Pjax::begin(); ?>
            <?= ListView::widget([
                'dataProvider' => $dataProviderVendauser,
                'itemOptions' => ['class' => 'col mb-5'],
                'summary' => '',
                'emptyText' => 'Não foram encontrados resultados.',
                'itemView' => '/vendauser/_item',
                'pager' => [
                    'class' => LinkPager::class
                ],
            ]) ?>
            <?php Pjax::end(); ?>
        <?php else: echo 'Não tem Propostas.' ?>
        <?php endif; ?>
    </div>

    <div class="reserve-index col-md-4">

        <h3>Reservas</h3>
        <?php if ($dataProviderReserve->count > 0): ?>
            <?php Pjax::begin(); ?>
            <?= ListView::widget([
                'dataProvider' => $dataProviderReserve,
                'itemOptions' => ['class' => 'col mb-5'],
                'summary' => '',
                'emptyText' => 'Não foram encontrados resultados.',
                'itemView' => '/reserve/_item',
                'pager' => [
                    'class' => LinkPager::class
                ],
            ]) ?>
            <?php Pjax::end(); ?>
        <?php else: echo 'Não tem Propostas.' ?>
        <?php endif; ?>
    </div>
</div>


