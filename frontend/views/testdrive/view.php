<?php

use common\models\Testdrive;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\Testdrive $model */

$this->title = 'Pedido de Test-Drive: #' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Área Pessoal', 'url' => ['site/areapessoal']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="testdrive-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
                'attribute' => 'idVehicle',
                'format' => ['html'],
                'value' => function ($model) {
                    return Html::a($model->idVehicle, Url::toRoute(['/vehicle/view', 'id' => $model->idVehicle]), [
                    ]);
                }
            ],
            [
                'attribute' => 'status',
                'format' => ['html'],
                'value' => function ($model) {
                    return Html::tag('span', $model->status == Testdrive::AGUARDANDO_RESPOSTA ? 'Necessário confirmar' : $model->status, [
                        'class' => $model->status == Testdrive::POR_VER ? 'badge bg-secondary' : ($model->status == Testdrive::ACEITE ? 'badge bg-success' : ($model->status == Testdrive::RECUSADO ? 'badge bg-danger' : 'badge bg-info'))
                    ]);
                }
            ],
            'date',
            'time',
            'description',
        ],
    ]) ?>

    <?php if ($model->status == 'Por ver'): ?>
        <p>
            <?= Html::a('Alterar', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
            <?= Html::a('Apagar', ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => 'Tem a certeza que quer apagar?',
                    'method' => 'post',
                ],
            ]) ?>
        </p>
    <?php elseif ($model->status == Testdrive::AGUARDANDO_RESPOSTA): ?>
        <p class="text">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-info-circle"
                 viewBox="0 0 16 16">
                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/>
            </svg>
            O seu pedido pode ter sofrido alterações, pois não existia dísponiblidade para o dia/hora anteriormente
            selecionada, porfavor confirme se aceita as novas alterações.
            Se não houver dísponiblidade pode sempre marcar novo test-drive ou <a class="text"
                                                                                  href="<?= Url::toRoute('/site/contact') ?>">contactar</a>
            para qualquer questão.
        </p>
        <p>
            <?= Html::a('Aceitar', ['confirm', 'id' => $model->id, 'value' => 'yes'], [
                'class' => 'btn btn-success',
                'data' => [
                    'confirm' => 'Tem a certeza que quer aceitar?',
                    'method' => 'post',
                ],
            ]) ?>
            <?= Html::a('Recusar', ['confirm', 'id' => $model->id, 'value' => 'no'], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => 'Tem a certeza que quer recusar?',
                    'method' => 'post',
                ],
            ]) ?>
        </p>
    <?php else: ?>
        <p class="text">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-info-circle"
                 viewBox="0 0 16 16">
                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/>
            </svg>
            Este Pedido não pode ser alterado porque já foi visto se tem alguma questão <a class="text"
                                                                                           href="<?= Url::toRoute('/site/contact') ?>">diga-nos.</a>
        </p>
    <?php endif; ?>


</div>
