<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\User $model */
/** @var yii\bootstrap5\ActiveForm $form */

//$this->registerJs("jQuery('#reveal-password').change(function(){jQuery('#user-password').attr('type',this.checked?'text':'password');})");
?>

<div class="user-form">
    <?php $form = ActiveForm::begin(); ?>

    <div class="container rounded bg-white mt-5 mb-5">
        <div class="row" style="background: #e9ecef">
            <div class="col-md-3 border-right">
                <div class="d-flex flex-column align-items-center text-center p-3 py-5"><img class="rounded-circle mt-5"
                                                                                             width="200px"
                                                                                             src="https://st3.depositphotos.com/15648834/17930/v/600/depositphotos_179308454-stock-illustration-unknown-person-silhouette-glasses-profile.jpg">
                    <span class="font-weight-bold"><?= $model->email ?></span>
                </div>
            </div>
            <div class="col-md-5 border-right">
                <div class="p-3 py-5">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="text-right"> Perfil </h4>
                    </div>
                    <div class="row mt-3">
                        <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

                        <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

                        <?= $form->field($model, 'username')->textInput(['maxlength' => true, 'placeholder' => 'Opcional']) ?>

                    </div>
                    <br>
                    <?= $form->field($model, 'changePassword')->checkbox(['onchange' => 'myShowPwd()']) ?>
                    <div id="password" style="display: none">
                        <?= $form->field($model, 'password')->passwordInput(['maxlength' => true]) ?>
                        <?= $form->field($model, 'passwordConf')->passwordInput(['maxlength' => true]) ?>
                    </div>

                </div>
                <div class="mt-5 text-center"><?= Html::submitButton('Guardar', ['class' => 'btn btn-dark']) ?></div>
            </div>
        </div>
    </div>

    <?php ActiveForm::end(); ?>
</div>

<script>
    function myShowPwd() {

        let isCheck = $('#user-changepassword').is(":checked");

        if (isCheck) {
            $('#password').show();
            $('#user-passwordconf').show();

        } else {
            $('#password').hide();
        }
    }
</script>





