<?php
use yii\bootstrap\Html;
use yii\helpers\Url;

/**
 * @var \app\modules\chat\models\Message[] $messages
 * @var \app\modules\chat\models\Message $model
 */
?>

<div class="chat-default-index">
    <?php foreach ($messages as $key => $message): ?>
        <?php if ( (!$message->is_correct && Yii::$app->user->identity->isAdmin) || $message->is_correct ): ?>
            <div class="row message <?= $message->isAdminMessage ? 'admin' : '' ?> <?= !$message->is_correct ? 'incorrect' : '' ?>">
                <div class="col-md-12">
                    <div class="row">
                        <p class="pull-left"><b><?= $message->user->username ?></b></p>
                        <?php if (!$message->isAdminMessage && $message->is_correct && Yii::$app->user->identity->isAdmin): ?>
                            <p class="pull-right">
                                <a href="<?= Url::to(['/chat/default/set-incorrect', 'id' => $message->id]) ?>">Пометить некорректным</a>
                            </p>
                        <?php endif; ?>
                    </div>
                </div>
                <p><?= $message->text ?></p>
                <span class="time-<?= $key % 2 == 0 ? 'right' : 'left' ?>"><?= date('H:m', $message->created_at) ?></span>
            </div>
        <?php endif; ?>
    <?php endforeach; ?>

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

                <?= Html::endForm() ?>
            </div>
        </div>
    <?php endif; ?>
</div>
