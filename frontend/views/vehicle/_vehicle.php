<?php //foreach ($vehicles as $vehicle): ?>

    <div class="card h-100">
        <!-- Vehicle image-->
        <img class="card-img-top" src="http://frontendstand.test/storage/<?= $model->image ?>"
             alt=""/>
        <!-- Vehicle details-->
        <div class="card-body p-4">
            <div class="text-center">
                <h5 class="fw-bolder"><?= $model->brand ?>, <span><?= $model->model ?></span></h5>
                <div class="text-secondary"><?= $model->year ?> | <?= $model->fuel ?>
                    | <?= $model->mileage ?> km
                </div>
                <!-- Product price-->
                <div class="text-secondary"> Preço:
                    <span><?= Yii::$app->formatter->asCurrency($model->price) ?></span></div>
            </div>
        </div>
        <!-- Product actions-->
        <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
            <div class="text-center"><a class="btn btn-outline-dark mt-auto"
                                        href="<?= Yii::$app->urlManager->createUrl(['vehicle/view', 'id' => $model->id]) ?>">Ver
                    mais</a></div>
        </div>
    </div>

<?php //endforeach; ?>
