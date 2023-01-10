<?php

use common\models\Vehicle;
use yii\helpers\Url;

?>


<div class="card h-100">
    <?php
    if ($model->status == Vehicle::STATUS_RESERVED) {
        echo '<div class="badge bg-dark text-white position-absolute" style="top: 0.5rem; right: 0.5rem">Reservado</div>';
    }
    ?>
    <!-- Vehicle image-->
    <img class="card-img-top" src="http://frontendstand.test/storage/<?= $model->image ?>"
         alt=""/>
    <!-- Vehicle details-->
    <div class="card-body p-4">
        <div class="text-center">
            <h5 class="fw-bolder"><?= $model->getBrandName() ?>, <span><?= $model->getModelName() ?></span></h5>
            <div class="text-secondary"><?= $model->year ?> | <?= $model->fuel ?>
                | <?= $model->mileage ?> km
            </div>
            <div class="text-secondary"> Preço:
                <span><?= Yii::$app->formatter->asCurrency($model->price) ?></span></div>
        </div>
    </div>
    <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
        <div class="text-center"><a class="btn btn-outline-dark mt-auto"
                                    href="<?= Url::toRoute(['vehicle/view', 'id' => $model->id]) ?>">Ver</a>
        </div>
    </div>
</div>
