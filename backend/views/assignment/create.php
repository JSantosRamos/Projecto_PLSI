<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\AuthAssignment $model */

$this->title = 'Novo perfil';
//$this->params['breadcrumbs'][] = ['label' => 'Auth Assignments', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => 'Utilizadores', 'url' => ['user/index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="auth-assignment-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
