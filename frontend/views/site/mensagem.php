<?php

use common\models\Testdrive;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;

/** @var yii\web\View $this */
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
