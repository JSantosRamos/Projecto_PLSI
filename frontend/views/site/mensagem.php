<?php

use common\models\Testdrive;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;

/** @var yii\web\View $this */
$this->title = 'Área Pessoal';
$this->params['breadcrumbs'][] = $this->title;
?>


<?php
/** @var common\models\TestdriveSearch $searchModelTestdrive */
/** @var yii\data\ActiveDataProvider $dataProviderTestdrive */
?>
<div class="testdrive-index">

    <?= $this->render('/testdrive/index', [
        'dataProvider' => $dataProviderTestdrive,
        'searchModel' => $searchModelTestdrive,
    ]) ?>
</div>

<hr style="color: blue">

<?php
/** @var common\models\VendauserSearch $searchModelVendauser */
/** @var yii\data\ActiveDataProvider $dataProviderVendauser */
?>
<div class="vendauser-index">

    <?= $this->render('/vendauser/index', [
        'dataProvider' => $dataProviderVendauser,
        'searchModel' => $searchModelVendauser,
    ]) ?>
</div>

<style>

    .custom-table thead tr, .custom-table thead th {
        padding-bottom: 30px;
        border-top: none;
        border-bottom: none !important;
        color: #000;
    }

    .custom-table tbody th, .custom-table tbody td {
        color: #777;
        padding-bottom: 20px;
        padding-top: 20px;
        font-weight: 300;
        border: none;
        -webkit-transition: .3s all ease;
        -o-transition: .3s all ease;
        transition: .3s all ease;
    }

    .custom-table tbody th small, .custom-table tbody td small {
        color: #b3b3b3;
        font-weight: 300;
    }

    .custom-table tbody tr {
        -webkit-transition: .3s all ease;
        -o-transition: .3s all ease;
        transition: .3s all ease;
    }

    .custom-table tbody tr .name {
        text-decoration: line-through;
        position: relative;
        display: inline-block;
    }

    .custom-table tbody tr .name:before {
        content: "";
        height: 2px;
        top: 50%;
        position: absolute;
        left: 0;
        right: 0;
        background: #dc3545;
        opacity: 0;
        visibility: hidden;
    }

    .custom-table tbody tr.active {
        opacity: .4;
    }

    .custom-table tbody tr.active .name:before {
        opacity: 1;
        visibility: visible;
    }

    .custom-table .td-box-wrap {
        padding: 0;
    }

    .custom-table .box {
        background: #fff;
        border-radius: 4px;
        margin-top: 15px;
        margin-bottom: 15px;
    }

    .custom-table .box td, .custom-table .box th {
        border: none !important;
    }
</style>

