<?php

use common\models\Vehicle;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\YiiAsset;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\Vehicle $model */
/** @var common\models\Image $vehicle_imagens array de imagens do veiculo */
/** @var common\models\Vehicle $items arrray de veiculos da mesma marca */

$this->title = $model->title;
YiiAsset::register($this);
?>
<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <meta name="description" content=""/>
    <meta name="author" content=""/>
    <title>Stand Auto</title>
    <h1><?= $model->title ?></h1>
    <!-- Bootstrap icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet"/>
    <style>
        .grid-container {
            display: grid;
            grid-template-columns: auto auto auto auto;
            grid-column-gap: 10px;
            grid-row-gap: 10px;
            background-color: white;
            padding: 10px;
        }

        .grid-container > div {
            background-color: #f8f9fa;
            text-align: center;
            padding: 10px;
            font-size: 20px;
        }
    </style>
</head>
<body>

<!-- Veiculo section-->
<section class="py-5 bg-light">
    <div class="container px-4 px-lg-5 my-5">
        <div class="row gx-4 gx-lg-5 align-items-center">
            <div class="col-md-6">
                <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="<?= $model->getImageUrl() ?>" class="d-block w-100"
                                 alt="...">
                        </div>

                        <?php if ($vehicle_imagens != null): ?>
                            <?php foreach ($vehicle_imagens as $image): ?>
                                <div class="carousel-item">
                                    <img src="http://frontendstand.test/storage/<?= $image->path ?>"
                                         class="d-block w-100" alt="...">
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>

                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls"
                            data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls"
                            data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
            <div class="col-md-6">
                <div class="small mb-1">Refêrencia: <?= $model->id ?></div>
                <h4 class="display-5 fw-bolder"><?= $model->getBrandName() ?>,
                    <span><?= $model->getModelName() ?></span></h4>
                <div class="fs-5 mb-5">
                    <span><?= Yii::$app->formatter->asCurrency($model->price) ?></span>
                </div>
                <p class="lead"><?= $model->description ?></p>
                <div class="d-flex">
                    <div class="text-center">
                        <a class="btn btn-outline-dark mt-auto" id="testdrive_book"
                           href="<?php echo Url::toRoute(['/testdrive/create', 'veiculo_id' => $model->id]) ?>">Test-Drive</a>
                        <a class="btn btn-outline-dark mt-auto" id="testdrive_book"
                           href="<?php echo Url::toRoute(['/reserve/create', 'veiculo_id' => $model->id]) ?>">Reservar</a>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <div class="grid-container">
            <div class="text-secondary">Marca: <br> <span class="text-dark"><?= $model->getBrandName() ?></span></div>
            <div class="text-secondary">Modelo: <br> <span class="text-dark"><?= $model->getModelName() ?></span></div>
            <div class="text-secondary">Série: <br> <span
                        class="text-dark"><?= $model->serie == "" ? "-" : $model->serie ?></span></div>
            <div class="text-secondary">Ano: <br> <span class="text-dark"><?= $model->year ?></span></div>
            <div class="text-secondary">Combustível: <br> <span class="text-dark"><?= $model->fuel ?></span></div>
            <div class="text-secondary">Portas: <br> <span class="text-dark"><?= $model->doorNumber ?></span></div>
            <div class="text-secondary">Quilometros: <br> <span class="text-dark"><?= $model->mileage ?> km</span></div>
            <div class="text-secondary">Cilindrada: <br> <span class="text-dark"><?= $model->engine ?> cm3</span></div>
            <div class="text-secondary">CV: <br> <span class="text-dark"><?= $model->cv ?></span></div>
            <div class="text-secondary">Caixa: <br> <span class="text-dark"><?= $model->transmission ?></span></div>
            <div class="text-secondary">Tipo de Veículo: <br> <span class="text-dark"><?= $model->type ?></span></div>
            <div class="text-secondary">Cor: <br> <span class="text-dark"><?= $model->color ?></span></div>
        </div>
</section>

<br>
<br>

<!-- Veiculos relacionados section-->
<section class="py-5 bg-light">
    <div class="container px-4 px-lg-5 mt-5">
        <h2 class="fw-bolder mb-4">Pode ser do seu Interesse.</h2>
        <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
            <?php foreach ($items as $item): ?>
                <div class="col mb-5">
                    <div class="card h-100">
                        <?php if ($model->status == Vehicle::STATUS_RESERVED) {
                            echo '<div class="badge bg-dark text-white position-absolute" style="top: 0.5rem; right: 0.5rem">Reservado</div>';
                        }
                        ?>
                        <!-- Vehicle image-->
                        <img class="card-img-top" src="<?= $item->getImageUrl()?>"
                             alt=""/>
                        <!-- Vehicle details-->
                        <div class="card-body p-4">
                            <div class="text-center">
                                <h5 class="fw-bolder"><?= $item->getBrandName() ?>,
                                    <span><?= $item->getModelName() ?></span></h5>
                                <div class="text-secondary"><?= $item->year ?> | <?= $item->fuel ?>
                                    | <?= $item->mileage ?> km
                                </div>
                                <!-- Product price-->
                                <div class="text-secondary"> Preço:
                                    <span><?= Yii::$app->formatter->asCurrency($item->price) ?></span></div>
                            </div>
                        </div>
                        <!-- Product actions-->
                        <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                            <div class="text-center"><a class="btn btn-outline-dark mt-auto"
                                                        href="<?= Yii::$app->urlManager->createUrl(['vehicle/view', 'id' => $item->id]) ?>">Ver
                                    mais</a></div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
</body>
</html>

