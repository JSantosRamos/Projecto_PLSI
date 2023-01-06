<?php

use common\models\User;
use yii\helpers\Html;
use yii\widgets\ActiveForm;


/** @var yii\web\View $this */
/** @var common\models\User $model */
/** @var yii\bootstrap5\ActiveForm $form */
?>

<div class="user-form">
    <?php $form = ActiveForm::begin();
    ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
    <div class="row">
        <div class="col-md-6"><?= $form->field($model, 'email')->Input('email') ?></div>
        <div class="col-md-6"><?= $form->field($model, 'username')->textInput(['maxlength' => true, 'placeholder' => 'Opcional...']) ?></div>
    </div>
    <div class="row">
        <div class="col-md-4"><?= $form->field($model, 'status')->dropDownList(['10' => 'Ativo', '9' => 'Desativa']) ?></div>
    </div>

    <?php
    if (Yii::$app->controller->action->id == 'update'):?>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" id="cbox" onclick="myShowPwd()">
            <label class="form-check-label" for="flexSwitchCheckDefault">Alterar Password</label>
        </div>
        <div id="password"
             style="display: none"> <?= $form->field($model, 'password')->passwordInput(['maxlength' => true]) ?>
        </div>
    <?php else:
        echo '<div class="row"><div class="col-md-4">' . $form->field($model, 'password_hash')->passwordInput(['maxlength' => true, 'value' => User::randomPassword(), 'disabled' => true]) . '</div> </div>';
    endif;
    ?>

    <?= $form->field($model, 'isEmployee')->checkbox() ?>

    <br>
    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-primary ']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<script>
    function myShowPwd() {

        let isCheck = $('#cbox').is(":checked");

        if (isCheck) {
            $('#password').show();
        } else {
            $('#password').hide();
        }
    }
</script>
