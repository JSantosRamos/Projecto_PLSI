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


<div class="row">
    <div class="col">
        <div class="vehicle-index">
            <!-- FORM VEHICLES -->
            <div class="vehicle-search">

                <?php Pjax::begin(['id' => 'filter_vehicle']) ?>
                <?php $form = ActiveForm::begin([
                    'action' => ['searchlist'],
                    'method' => 'get',
                    'options' => ['data-pjax' => true]
                ]); ?>

                <h5>Procurar por:</h5>
                <div class="row">
                    <div class="col-md-3"><?php echo $form->field($searchVehicle, 'id')->textInput(['placeholder' => 'Referência'])->label(false) ?></div>
                    <div class="col-md-3"> <?php echo $form->field($searchVehicle, 'brand')->textInput(['placeholder' => 'Marca'])->label(false) ?></div>
                    <div class="col-md-3"><?php echo $form->field($searchVehicle, 'plate')->textInput(['placeholder' => 'Matrícula'])->label(false) ?></div>
                </div>
                <div class="form-group">
                    <?= Html::submitButton('Procurar', ['class' => 'btn btn-primary']) ?>
                    <?= Html::a('Reset', ['searchlist'], ['class' => 'btn btn-outline-secondary']) ?>
                </div>
                <?php ActiveForm::end(); ?>
                <?php Pjax::end() ?>

            </div>

            <!-- START VIEW TABLE -->
            <?php Pjax::begin(['id' => 'listvehicles']) ?>
            <?= GridView::widget([
                'dataProvider' => $dataVehicle,
                'columns' => [
                    'id',
                    [
                        'attribute' => 'image',
                        'content' => function ($model) {
                            return Html::img($model->getImageUrl(), ['style' => 'width: 100px']);
                        }
                    ],
                    'title',
                    'plate',
                    'brand',
                    'model',
                    'price:currency',
                    [
                        'attribute' => 'isActive',
                        'content' => function ($model) {
                            return Html::tag('span', $model->isActive ? 'Publicado' : 'Não Publicado', [
                                'class' => $model->isActive ? 'badge bg-success' : 'badge bg-danger'
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


    <div class="col">
        <div class="user-index">
            <!-- FORM USERS -->
            <div class="user-search">

                <?php Pjax::begin(['id' => 'filter_user']) ?>
                <?php $form = ActiveForm::begin([
                    'action' => ['searchlist'],
                    'method' => 'get',
                    'options' => ['data-pjax' => true]
                ]); ?>

                <h5>Procurar por:</h5>
                <div class="row">
                    <div class="col-md-4"><?php echo $form->field($searchUser, 'username')->textInput(['placeholder' => 'Username'])->label(false) ?></div>
                    <div class="col-md-4"> <?php echo $form->field($searchUser, 'email')->textInput(['placeholder' => 'Email'])->label(false) ?></div>
                </div>
                <div class="form-group">
                    <?= Html::submitButton('Procurar', ['class' => 'btn btn-primary']) ?>
                    <?= Html::a('Reset', ['searchlist'], ['class' => 'btn btn-outline-secondary']) ?>
                </div>
                <?php ActiveForm::end(); ?>
                <?php Pjax::end() ?>

            </div>

            <!-- START VIEW TABLE -->
            <?php Pjax::begin(['id' => 'listusers']) ?>
            <?= GridView::widget([
                'dataProvider' => $dataUser,
                'columns' => [
                    'id',
                    'username',
                    'email:email',
                    /* [
                         'attribute' => 'status',
                         'format' => ['html'],
                         'value' => function ($model) {
                             return Html::tag('span', $model->status == 10 ? 'Ativo' : 'Desativo', [
                                 'class' => $model->status == 10 ? 'badge bg-success' : 'badge bg-danger'
                             ]);
                         }
                     ],*/
                    [
                        'class' => ActionColumn::className(),
                        'template' => '{view}',
                        'urlCreator' => function ($action, User $model, $key, $index, $column) {
                            return Url::toRoute(['/user/view', 'id' => $model->id]);
                        }
                    ],
                ],
            ]); ?>
            <?php Pjax::end() ?>
        </div>
    </div>
</div>



