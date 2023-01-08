<?php

use common\models\Testdrive;
use yii\bootstrap5\LinkPager;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\ListView;

/** @var yii\web\View $this */
/** @var common\models\TestdriveSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */
$this->title = 'Test-Drives';
?>


<h3><?= Html::encode($this->title) ?></h3>

<?php if ($dataProvider->count > 0): ?>
    <div class="table-responsive">
        <table class="table table-striped custom-table">
            <thead>
            <tr class="active">
                <th scope="col"></th>
                <th scope="col">Referência</th>
                <th scope="col">Dia</th>
                <th scope="col">Hora</th>
                <th scope="col">Estado</th>
            </tr>
            </thead>
            <tbody>
            <tr class="">
                <?= ListView::widget([
                    'dataProvider' => $dataProvider,
                    'itemOptions' => ['class' => 'col mb-5'],
                    'summary' => '',
                    'emptyText' => 'Não foram encontrados resultados.',
                    'itemView' => '_item',
                    'pager' => [
                        'class' => LinkPager::class
                    ],
                ]) ?>
            </tr>
            </tbody>
        </table>
    </div>

<?php else: echo 'Não tem test-drives agendados.' ?>
<?php endif; ?>

