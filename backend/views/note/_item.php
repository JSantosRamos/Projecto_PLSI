<?php

use common\models\User;
use yii\helpers\Html;
use yii\helpers\Url;

$sessionID = Yii::$app->user->id;

?>

<p><?= $model->description; ?></p>
<p>
    <br><b>Criado por: <?= User::getNameById($model->idUser); ?> a <?= $model->create_at; ?></b>
</p>

<?php if (User::isEmployee($sessionID) && $model->idUser != $sessionID): ?>
    <p></p>
<?php else: ?>
    <p>
        <?= Html::a('Editar', Url::toRoute(['note/update', 'id' => $model->id]), ['class' => 'text']) ?>
        <?= Html::a('Apagar', Url::toRoute(['note/delete', 'id' => $model->id]), [
            'class' => 'text',
            'data' => [
                'confirm' => 'Tem a certeza que quer apagar?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

<?php endif; ?>

<hr style="border: 1px solid blue">