<?php

use common\models\User;
use yii\helpers\Html;
use yii\helpers\Url;
?>

<p><?= $model->description; ?></p>
<p>
    <br><span>Criado por: <?= User::getName($model->idUser) ; ?> a <?= $model->create_at; ?> </span>
</p>
<p>
    <?= Html::a('Editar', Url::toRoute(['note/update', 'id' => $model->id]), ['class' => 'text']) ?>
    <?= Html::a('Apagar', Url::toRoute(['note/delete', 'id' => $model->id]), [
        'class' => 'text',
        'data' => [
            'confirm' => 'Are you sure you want to delete this item?',
            'method' => 'post',
        ],
    ]) ?>
</p>

<hr style="border: 1px solid blue">