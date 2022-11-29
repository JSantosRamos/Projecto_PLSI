<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\Vehicle $model */

$this->title = $model->title;
//$this->params['breadcrumbs'][] = ['label' => 'Vehicles', 'url' => ['index']];
//$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <meta name="description" content=""/>
    <meta name="author" content=""/>
    <title>Auto Shop</title>
    <h1><?= $model->title ?></h1>
    <!-- Bootstrap icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet"/>
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="css/styles.css" rel="stylesheet"/>
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

<!-- Product section-->
<section class="py-5 bg-light">
    <div class="container px-4 px-lg-5 my-5">
        <div class="row gx-4 gx-lg-5 align-items-center">
            <div class="col-md-6">
                <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-indicators">
                        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0"
                                class="active" aria-current="true" aria-label="Slide 1"></button>
                        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"
                                aria-label="Slide 2"></button>
                        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"
                                aria-label="Slide 3"></button>
                    </div>
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="http://frontendstand.test/storage/<?= $model->image ?>" class="d-block w-100"
                                 alt="...">
                        </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
                            data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
                            data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
            <div class="col-md-6">
                <div class="small mb-1">Refêrencia: <?= $model->id ?></div>
                <h4 class="display-5 fw-bolder"><?= $model->brand ?>, <span><?= $model->model ?></span></h4>
                <div class="fs-5 mb-5">
                    <span><?= Yii::$app->formatter->asCurrency($model->price) ?></span>
                </div>
                <p class="lead"><?= $model->description ?></p>
                <div class="d-flex">
                    <div class="text-center">
                        <a class="btn btn-outline-dark mt-auto"
                           href="<?php echo Url::toRoute(['/testdrive/create', 'veiculo_id' => $model->id, 'veiculo_info' => $model->brand . ', ' . $model->model]) ?>">
                            Teste-Drive
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                 class="bi bi-car-front-fill" viewBox="0 0 16 16">
                                <path d="M2.52 3.515A2.5 2.5 0 0 1 4.82 2h6.362c1 0 1.904.596 2.298 1.515l.792 1.848c.075.175.21.319.38.404.5.25.855.715.965 1.262l.335 1.679c.033.161.049.325.049.49v.413c0 .814-.39 1.543-1 1.997V13.5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1-.5-.5v-1.338c-1.292.048-2.745.088-4 .088s-2.708-.04-4-.088V13.5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1-.5-.5v-1.892c-.61-.454-1-1.183-1-1.997v-.413a2.5 2.5 0 0 1 .049-.49l.335-1.68c.11-.546.465-1.012.964-1.261a.807.807 0 0 0 .381-.404l.792-1.848ZM3 10a1 1 0 1 0 0-2 1 1 0 0 0 0 2Zm10 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2ZM6 8a1 1 0 0 0 0 2h4a1 1 0 1 0 0-2H6ZM2.906 5.189a.51.51 0 0 0 .497.731c.91-.073 3.35-.17 4.597-.17 1.247 0 3.688.097 4.597.17a.51.51 0 0 0 .497-.731l-.956-1.913A.5.5 0 0 0 11.691 3H4.309a.5.5 0 0 0-.447.276L2.906 5.19Z"/>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <div class="grid-container">
            <div class="text-secondary">Ano: <br> <span class="text-dark"><?= $model->year ?></span></div>
            <div class="text-secondary">Combustível: <br> <span class="text-dark"><?= $model->fuel ?></span></div>
            <div class="text-secondary">Portas: <br> <span class="text-dark"><?= $model->doorNumber ?></span></div>
            <div class="text-secondary">Quilometros: <br> <span class="text-dark"><?= $model->mileage ?> km</span></div>
            <div class="text-secondary">Cilindrada: <br> <span class="text-dark"><?= $model->engine ?> cm3</span></div>
            <div class="text-secondary">Caixa: <br> <span class="text-dark"><?= $model->transmission ?></span></div>
            <div class="text-secondary">Tipo de Veículo: <br> <span class="text-dark"><?= $model->type ?></span></div>
            <div class="text-secondary">Cor: <br> <span class="text-dark"><?= $model->color ?></span></div>
        </div>
</section>

<br>
<br>

<!-- Related items section-->
<section class="py-5 bg-light">
    <div class="container px-4 px-lg-5 mt-5">
        <h2 class="fw-bolder mb-4">Pode ser do seu Interesse.</h2>
        <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
            <?php foreach ($items as $item): ?>
                <div class="col mb-5">
                    <div class="card h-100">
                        <!-- Vehicle image-->
                        <img class="card-img-top" src="http://frontendstand.test/storage/<?= $item->image ?>"
                             alt=""/>
                        <!-- Vehicle details-->
                        <div class="card-body p-4">
                            <div class="text-center">
                                <h5 class="fw-bolder"><?= $item->brand ?>, <span><?= $item->model ?></span></h5>
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
<!-- Bootstrap core JS-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

