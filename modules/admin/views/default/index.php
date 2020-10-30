<?php

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var array $roles */

$this->title = 'Users';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="module-index">
    <div class="row form-group">
        <div class="col-md-12">
            <?= Html::a('Просмотр спам сообщений', '/admin/chat', [
                'class' => 'btn btn-default btn-primary'
            ]) ?>
        </div>
    </div>

    <h1><?= Html::encode($this->title) ?></h1>

    <?php $form = ActiveForm::begin(); ?>
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                'username',
                'email',
                'status:boolean:Active',

                [
                    'attribute' => 'group',
                    'value' => function($model, $key, $index) use ($roles) {
                        return Html::activeDropDownList($model, "[$key]group", $roles, ['class'=>'form-control']);
                    },
                    'format' => 'raw',
                ],

                'created_at:relativeTime',
                'updated_at:relativeTime',
            ],
        ]); ?>

        <div class="form-group">
            <div class="row">
                <div class="col-md-2 pull-right">
                    <?= Html::submitButton('Save', ['class' => 'btn btn-success form-control']) ?>
                </div>
            </div>
        </div>
    <?php ActiveForm::end(); ?>


</div>
