<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>
<?php $form = ActiveForm::begin([
    'id' => 'login-form',
//    'enableAjaxValidation' => true,
    'options' => [
        'class' => 'form-vertical bc-form-passwordMethod',
    ],
]); ?>

    <?= $form->field($model, 'username')
        ->label(false)
        ->textInput([
            'autofocus' => true,
            'placeholder' => 'Логин (телефон, email или СНИЛС)',
        ])
    ?>

    <?php ob_start(); ?>
        <div class="posr">
            <span class="append-icon right">
                <i id="show_password" class="fa fa-eye-slash"></i>
            </span>
            {input}
            {error}
        </div>
    <?php $fieldTemplate = ob_get_clean(); ?>

    <?= $form->field($model, 'password', [
            'template' => $fieldTemplate,
        ])
        ->label(false)
        ->passwordInput(['placeholder' => 'Введите пароль'])
    ?>

    <div class="form-group pb15">
        <div class="col-sm-6">
            <div class="checkbox-custom bc-checkbox-alien">
                <?= Html::activeCheckbox($model, 'rememberMe', [
                    'id' => 'notRememberMe',
                    'label' => null,
                ]) ?>
                <label for="notRememberMe">Чужой компьютер</label>
            </div>
        </div>
        <div class="col-sm-6">
            <div id="recoveryEnter" class="text-right bc-recovery-url">
                <a href="/sps/recovery">Забыли пароль?</a>
            </div>
        </div>
    </div>

    <?= Html::submitButton('Войти', [
        'class' => 'btn btn-lg btn-primary btn-block bc-form-btn',
        'name' => 'login-button',
    ]) ?>

<?php ActiveForm::end(); ?>
