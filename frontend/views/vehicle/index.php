<?php

use common\models\Vehicle;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var common\models\VehicleSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */
/** @var common\models\Vehicle $model */

$this->title = 'Veículos';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <!-- Bootstrap icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="css/styles.css" rel="stylesheet" />
</head>
<body>

<!-- Header-->
<header class="bg-dark py-5">
    <div class="container px-2 px-lg-2 my-2">
        <div class="text-center text-white">
            <h1><?= Html::encode($this->title) ?></h1>
        </div>
    </div>
</header>
<!-- Section-->
<section class="py-5">
    <div class="container px-4 px-lg-5 mt-5">
        <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
            <?php foreach ($vehicles as $vehicle): ?>
            <div class="col mb-5">
                <div class="card h-100">
                    <!-- Vehicle image-->
                    <img class="card-img-top" src="http://frontendstand.test/storage/<?=$vehicle->image?>" alt="" />
                    <!-- Vehicle details-->
                    <div class="card-body p-4">
                        <div class="text-center">
                            <h5 class="fw-bolder"><?= $vehicle->brand?>, <span><?= $vehicle->model?></span></h5>
                            <div class="text-secondary"><?=$vehicle->year ?> | <?= $vehicle->fuel ?> | <?=$vehicle->mileage ?> km </div>
                            <!-- Product price-->
                            <div class="text-secondary"> Preço: <span><?= Yii::$app->formatter->asCurrency($vehicle->price) ?></span></div>
                        </div>
                    </div>
                    <!-- Product actions-->
                    <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                        <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="<?= Yii::$app->urlManager->createUrl(['vehicle/view', 'id' => $vehicle->id])?>">Ver mais</a></div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<!-- Bootstrap core JS-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<!-- Core theme JS-->
<script src="js/scripts.js"></script>
</body>
</html>