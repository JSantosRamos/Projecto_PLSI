<?php

use common\models\Testdrive;
use yii\helpers\Html;
use yii\helpers\Url;
?>

<div class="card">
    <h5 id="cardstatus" class="card-header">Estado: <?= $model->status ?></h5>
    <div class="card-body">
        <h5 class="card-title">Data: <?= $model->date ?> | Hora: <?= $model->time ?></h5>
        <p class="card-text"><?= $model->description ?> </p>
        <a href="<?= Url::toRoute(['testdrive/view', 'id' => $model->id]) ?>" class="btn btn-outline-primary">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye-fill"
                 viewBox="0 0 16 16">
                <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z"/>
                <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z"/>
            </svg>
        </a>
    </div>
</div>