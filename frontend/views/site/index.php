<?php

/** @var yii\web\View $this */

use yii\helpers\Html;
use yii\helpers\Url;
use kv4nt\owlcarousel\OwlCarouselWidget;

$this->title = 'Stand Auto';
?>

<title><?= Html::encode($this->title) ?></title>
<section style="background: url('http://frontendstand.test/homepage/img.png') no-repeat center center;">
    <div class="container px-5">
        <div class="row gx-5 justify-content-center">
            <div class="col-lg-6">
                <div class="text-center my-5">
                    <h1 class="display-5 fw-bolder text-white mb-2">STAND AUTO</h1>
                    <br>
                    <br>
                    <p class="lead text-white-50 mb-4">Veja todas a nossas viaturas aos melhores preços, encontre o
                        melhor negócio para si!</p>
                </div>
            </div>
        </div>
    </div>

</section>
<!-- Features section-->
<section class="py-5 border-bottom" id="features">
    <div class="container px-5 my-5">
        <div class="row gx-5">
            <div class="col-lg-4 mb-5 mb-lg-0">
                <h2 class="h4 fw-bolder">Veículos
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                         class="bi bi-car-front-fill" viewBox="0 0 16 16">
                        <path d="M2.52 3.515A2.5 2.5 0 0 1 4.82 2h6.362c1 0 1.904.596 2.298 1.515l.792 1.848c.075.175.21.319.38.404.5.25.855.715.965 1.262l.335 1.679c.033.161.049.325.049.49v.413c0 .814-.39 1.543-1 1.997V13.5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1-.5-.5v-1.338c-1.292.048-2.745.088-4 .088s-2.708-.04-4-.088V13.5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1-.5-.5v-1.892c-.61-.454-1-1.183-1-1.997v-.413a2.5 2.5 0 0 1 .049-.49l.335-1.68c.11-.546.465-1.012.964-1.261a.807.807 0 0 0 .381-.404l.792-1.848ZM3 10a1 1 0 1 0 0-2 1 1 0 0 0 0 2Zm10 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2ZM6 8a1 1 0 0 0 0 2h4a1 1 0 1 0 0-2H6ZM2.906 5.189a.51.51 0 0 0 .497.731c.91-.073 3.35-.17 4.597-.17 1.247 0 3.688.097 4.597.17a.51.51 0 0 0 .497-.731l-.956-1.913A.5.5 0 0 0 11.691 3H4.309a.5.5 0 0 0-.447.276L2.906 5.19Z"/>
                    </svg>
                </h2>
                <p>Veja todas a nossas viaturas aos melhores preços, encontre o melhor negócio para si.</p>
                <a class="text-decoration-none" href="<?php echo Url::toRoute(['/vehicle/index']) ?>">
                    Ver mais
                </a>
            </div>
            <div class="col-lg-4 mb-5 mb-lg-0">
                <h2 class="h4 fw-bolder">Vender o seu carro
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                         class="bi bi-wallet-fill" viewBox="0 0 16 16">
                        <path d="M1.5 2A1.5 1.5 0 0 0 0 3.5v2h6a.5.5 0 0 1 .5.5c0 .253.08.644.306.958.207.288.557.542 1.194.542.637 0 .987-.254 1.194-.542.226-.314.306-.705.306-.958a.5.5 0 0 1 .5-.5h6v-2A1.5 1.5 0 0 0 14.5 2h-13z"/>
                        <path d="M16 6.5h-5.551a2.678 2.678 0 0 1-.443 1.042C9.613 8.088 8.963 8.5 8 8.5c-.963 0-1.613-.412-2.006-.958A2.679 2.679 0 0 1 5.551 6.5H0v6A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-6z"/>
                    </svg>
                </h2>
                <p>Tem um automóvel para vender? Nós temos a proposta ideal para si.
                    Tratamos de todo o processo de forma rápida e simples!</p>
                <a class="text-decoration-none" href="<?php echo Url::toRoute(['/vendauser/create']) ?>">
                    Ver mais
                </a>
            </div>
            <div class="col-lg-4">
                <h2 class="h4 fw-bolder">Área Cliente
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-person-fill" viewBox="0 0 16 16">
                        <path d="M12 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2zm-1 7a3 3 0 1 1-6 0 3 3 0 0 1 6 0zm-3 4c2.623 0 4.146.826 5 1.755V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1v-1.245C3.854 11.825 5.377 11 8 11z"/>
                    </svg>
                </h2>
                <p>Consulte os seus test-drives e propostas de venda!</p>
                <a class="text-decoration-none" href="<?php echo Url::toRoute(['/site/areapessoal']) ?>">
                    Ver mais
                </a>
            </div>
        </div>
    </div>
</section>


<section class="py-5">
    <div class="container px-4 px-lg-5 mt-5">
        <?php OwlCarouselWidget::begin([
            'container' => 'div',
            'assetType' => OwlCarouselWidget::ASSET_TYPE_CDN,
            'jqueryFunction' => 'jQuery',// or $
            'containerOptions' => [
                'id' => 'container-id',
                'class' => 'container-class owl-theme'
            ],
            'pluginOptions' => [
                'autoplay' => true,
                'autoplayTimeout' => 3000,
                'items' => 3,
                'loop' => true,
                'itemsDesktop' => [1199, 3],
                'itemsDesktopSmall' => [979, 3]
            ]
        ]);
        ?>

        <?php foreach ($vehicles as $vehicle): ?>
            <div class="card h-100">
                <!-- Vehicle image-->
                <img class="card-img-top" src="http://frontendstand.test/storage/<?= $vehicle->image ?>"
                     alt=""/>
                <!-- Vehicle details-->
                <div class="card-body p-4">
                    <div class="text-center">
                        <h5 class="fw-bolder"><?= $vehicle->getBrandName() ?>,
                            <span><?= $vehicle->getModelName() ?></span></h5>
                        <div class="text-secondary"><?= $vehicle->year ?> | <?= $vehicle->fuel ?>
                            | <?= $vehicle->mileage ?> km
                        </div>
                        <!-- Product price-->
                        <div class="text-secondary"> Preço:
                            <span><?= Yii::$app->formatter->asCurrency($vehicle->price) ?></span></div>
                    </div>
                </div>
                <!-- Product actions-->
                <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                    <div class="text-center"><a class="btn btn-outline-dark mt-auto"
                                                href="<?= Yii::$app->urlManager->createUrl(['vehicle/view', 'id' => $vehicle->id]) ?>">Ver
                            mais</a></div>
                </div>
            </div>

        <?php endforeach; ?>

        <?php OwlCarouselWidget::end(); ?>
    </div>
</section>

