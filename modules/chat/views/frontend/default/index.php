<?php

use app\modules\chat\models\Message;
use yii\bootstrap\Html;
use yii\data\ActiveDataProvider;
use yii\data\Pagination;
use yii\widgets\LinkPager;
use yii\widgets\ListView;

/**
 * @var \yii\web\View $this
 * @var ActiveDataProvider $dataProvider
 * @var Message $model
 * @var Pagination $pager
 */
?>

<div class="chat-default-index">
    <?php if (Yii::$app->user->can('createMessage')): ?>
        <div class="row">
            <div class="col-md-12">
                <?= Html::beginForm() ?>

                <?= Html::activeHiddenInput($model, 'user_id', [
                    'value' => Yii::$app->user->getId(),
                ]) ?>

                <div class="input-group">
                    <?= Html::activeInput('text', $model, 'text', ['class'=> 'form-control']) ?>
                    <span class="input-group-btn">
                        <?= Html::submitButton('Send message', ['class' => 'btn btn-success']) ?>
                    </span>
                </div>
                <?= Html::error($model, 'text') ?>

                <?= Html::endForm() ?>
            </div>
        </div>
    <?php endif; ?>

    <div class="messages-container">
        <?= ListView::widget([
            'dataProvider' => $dataProvider,
            'itemView' => '_message',
            'summary' => false,
            'options' => [
                'tag' => false,
            ],
            'itemOptions' => [
                'tag' => 'div',
                'class' => 'item',
            ],
        ]); ?>
    </div>

    <?= LinkPager::widget([
        'pagination' => $pager,
    ]); ?>

    <div class="scroller-status">
        <div class="loader-ellips infinite-scroll-request">
            <span class="loader-ellips__dot"></span>
            <span class="loader-ellips__dot"></span>
            <span class="loader-ellips__dot"></span>
            <span class="loader-ellips__dot"></span>
        </div>
    </div>
</div>
