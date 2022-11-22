<?php

use common\models\Vehicle;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\ListView;
use yii\widgets\Pjax;

/** @var yii\web\View $this */
/** @var common\models\VehicleSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */
/** @var common\models\Vehicle $model */

$this->title = 'Veículos';

$this->registerJs('$("document").ready(function(){ 
		$("#filter_show_vehicles").on("pjax:end", function() {
			$.pjax.reload({container:"#show_vehicles"});  //Reload GridView
		});
    });'

);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <meta name="description" content=""/>
    <meta name="author" content=""/>
    <!-- Bootstrap icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet"/>
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="css/styles.css" rel="stylesheet"/>
    <title><?= $this->title ?></title>
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

<!-- Filter-->
<br>
<?php echo $this->render('_search', ['model' => $searchModel]);
?>
<hr>

<section class="py-5">
    <div class="container px-4 px-lg-5 mt-5">
        <?php Pjax::begin(['id' => 'show_vehicles']) ?>
        <?= ListView::widget([
            'dataProvider' => $dataProvider,
            'layout' => '<div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">{items}</div>',
            'itemView' => '_vehicle',
            'itemOptions' => ['class' => 'col mb-5']
        ]) ?>
        <?php Pjax::end() ?>
    </div>
</section>

<!-- Bootstrap core JS-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>