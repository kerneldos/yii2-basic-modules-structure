<?php

use yii\bootstrap\ActiveForm;
use yii\bootstrap\Html;
use yii\grid\GridView;

/** @var \yii\data\ActiveDataProvider $dataProvider  */

$this->title = 'Некорректные сообщения';
$this->params['breadcrumbs'][] = $this->title;

?>

<h1><?= Html::encode($this->title) ?></h1>

<?php $form = ActiveForm::begin(); ?>
    <?= GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],

        [
            'attribute' => 'is_correct',
            'label' => 'Пометить корректным?',
            'value' => function($model, $key, $index) {
                return Html::activeCheckbox($model, "[$key]is_correct", ['label' => false]);
            },
            'format' => 'raw',
        ],

        'text:ntext',
        'user.username',
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
