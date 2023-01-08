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

    <?= $form->field($model, 'isEmployee')->checkbox() ?>

    <?php if (Yii::$app->controller->action->id == 'create'): ?>
        <?= $form->field($model, 'password_hash')->passwordInput(['maxlength' => true, 'value' => User::randomPassword(), 'readonly' => true]) ?>

    <?php elseif (Yii::$app->controller->action->id == 'update' && User::isAdmin(Yii::$app->user->id)): ?>
        <?= $form->field($model, 'changePassword')->checkbox(['onchange' => 'myShowPwd()']) ?>
        <div id="password" style="display: none">
            <?= $form->field($model, 'password')->passwordInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'passwordConf')->passwordInput(['maxlength' => true]) ?>
        </div>
    <?php else: ?>
        <?= $form->field($model, 'password_hash')->hiddenInput(['maxlength' => true, 'readonly' => true])->label(false) ?>
    <?php endif; ?>

    <br>
    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-primary ']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<script>
    function myShowPwd() {
        let isCheck = $('#user-changepassword').is(":checked");

        if (isCheck) {
            $('#password').show();
        } else {
            $('#password').hide();
        }
    }
</script>
