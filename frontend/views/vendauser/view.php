<?php

use common\models\Vendauser;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\Vendauser $model */

$this->title = 'Proposta de venda: #' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Vendausers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="vendauser-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'plate',
            'price:currency',
            [
                'attribute' => 'mileage',
                'value' => $model->mileage . ' km',
            ],
            'fuel',
            'year',
            'brand',
            'model',
            [
                'attribute' => 'serie',
                'value' => $model->serie == null ? 'Sem serie' : $model->serie,
            ],
            [
                'attribute' => 'description',
                'value' => $model->description == null ? 'Sem extras' : $model->description,
            ],
            [
                'attribute' => 'status',
                'format' =>['html'],
                'value' => function ($model) {
                    return Html::tag('span', $model->status ,[
                        'class' => $model->status == Vendauser::POR_VER ? 'badge bg-secondary' : ($model->status == Vendauser::ACEITE ? 'badge bg-success' : ($model->status == Vendauser::RECUSADO ? 'badge bg-danger' : 'badge bg-primary'))
                    ]);
                }
            ],
        ],
    ]) ?>

    <?php if ($model->status == \common\models\Testdrive::POR_VER): ?>
        <p>
            <?= Html::a('Alterar', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
            <?= Html::a('Apagar', ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => 'Are you sure you want to delete this item?',
                    'method' => 'post',
                ],
            ]) ?>
        </p>

    <?php elseif($model->status == \common\models\Testdrive::ACEITE): ?>

        <p class="text-success">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-info-circle"
                 viewBox="0 0 16 16">
                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/>
            </svg>
            A sua proposta foi aceite iremos entrar em contacto brevemente!
        </p>

    <?php elseif($model->status == \common\models\Testdrive::RECUSADO): ?>

    <p class="text-danger">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-info-circle"
             viewBox="0 0 16 16">
            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
            <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/>
        </svg>
       A sua proposta foi recusada, não é o que procuramos de momento, obrigado pelo seu contacto. <a class="" href="<?= Url::toRoute('/site/contact') ?>">Qualquer questão contacte-nos.</a>
    </p>
    <?php endif; ?>

</div>

