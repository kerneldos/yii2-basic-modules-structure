<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \app\models\LoginForm */

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="row">
    <div class="col-md-6">
        <?php $form = ActiveForm::begin([
            'id' => 'login-form',
            'options' => [
                'class' => 'form-vertical',
            ],
        ]); ?>

        <?= $form->field($model, 'username')
            ->label(false)
            ->textInput([
                'autofocus' => true,
                'placeholder' => 'Username',
            ])
        ?>

        <?= $form->field($model, 'password')
            ->label(false)
            ->passwordInput([
                'placeholder' => 'Password',
            ])
        ?>

        <div class="form-group">
            <?= Html::activeCheckbox($model, 'rememberMe', [
                'id' => 'rememberMe',
                'label' => null,
            ]) ?>
            <label for="rememberMe">Remember Me</label>
        </div>

        <?= Html::submitButton('Войти', [
            'class' => 'btn btn-primary btn-block',
            'name' => 'login-button',
        ]) ?>

        <?php ActiveForm::end(); ?>
    </div>
</div>
