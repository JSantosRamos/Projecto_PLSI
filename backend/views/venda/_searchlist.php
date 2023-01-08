<?php

use common\models\User;
use common\models\Vehicle;
use yii\bootstrap5\ActiveForm;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ListView;
use yii\widgets\Pjax;

/** @var yii\web\View $this */
/** @var common\models\VehicleSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Veículos';
$this->params['breadcrumbs'][] = $this->title;

$this->registerJs('$("document").ready(function(){
		$("#filter_vehicle").on("pjax:end", function() {
			$.pjax.reload({container:"#listvehicles"});  //Reload GridView
		});
    });'
);

$this->registerJs('$("document").ready(function(){ 
		$("#filter_user").on("pjax:end", function() {
			$.pjax.reload({container:"#listusers"});  //Reload GridView
		});
    });'

);
?>

<div class="venda-searchlist">

    <div class="row">
        <div class="col">
            <!-- FORM VEHICLES -->
            <div class="vehicle-search">

                <?php Pjax::begin(['id' => 'filter_vehicle']) ?>
                <?php $form = ActiveForm::begin([
                    'action' => ['create'],
                    'method' => 'get',
                    'options' => ['data-pjax' => true]
                ]); ?>

                <h5>Procurar por:</h5>
                <div class="row">
                    <div class="col-md-3"> <?php echo $form->field($searchVehicle, 'brand')->textInput(['placeholder' => 'Marca'])->label(false) ?></div>
                    <div class="col-md-3"><?php echo $form->field($searchVehicle, 'plate')->textInput(['placeholder' => 'Matrícula'])->label(false) ?></div>
                    <div class="col-md-3"><?php echo $form->field($searchVehicle, 'status')->dropDownList(['Vendido' => 'Vendidos', 'Reservado' => 'Reservados', 'Disponível' => 'Disponíveis'], ['prompt' => '  Todos',])->label(false) ?></div>
                </div>
                <div class="form-group">
                    <?= Html::submitButton('Procurar', ['class' => 'btn btn-primary']) ?>
                    <?= Html::a('Reset', ['create'], ['class' => 'btn btn-outline-secondary']) ?>
                </div>
                <?php ActiveForm::end(); ?>
                <?php Pjax::end() ?>

            </div>

            <!-- START VIEW TABLE -->
            <?php Pjax::begin(['id' => 'listvehicles']) ?>
            <?= GridView::widget([
                'dataProvider' => $dataVehicle,
                'summary' => '',
                'emptyText' => 'Não foram encontrados resultados.',
                'columns' => [
                    'id',
                    [
                        'attribute' => 'image',
                        'content' => function ($model) {
                            return Html::img($model->getImageUrl(), ['style' => 'width: 100px']);
                        }
                    ],
                    'plate',
                    [
                        'attribute' => 'idBrand',
                        'value' => function ($model) {
                            return $model->getBrandName();
                        }
                    ],
                    'price:currency',
                    [
                        'attribute' => 'status',
                        'format' => ['html'],
                        'value' => function ($model) {
                            return Html::tag('span', $model->status, [
                                'class' => $model->status == Vehicle::STATUS_AVAILABLE ? 'badge bg-primary' : ($model->status == Vehicle::STATUS_RESERVED ? 'badge bg-warning' : 'badge bg-success')
                            ]);
                        }
                    ],
                    [
                        'class' => ActionColumn::className(),
                        'template' => '{view}',
                        'urlCreator' => function ($action, Vehicle $model, $key, $index, $column) {
                            return Url::toRoute(['/vehicle/view', 'id' => $model->id]);
                        }
                    ],
                ],
            ]); ?>
            <?php Pjax::end() ?>
        </div>
    </div>
</div>



