<?php

use app\modules\chat\models\Message;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ListView;

/**
 * @var Message $model
 * @var mixed $key
 * @var integer $index
 * @var ListView $widget
 */
?>

<?php if ( (!$model->is_correct && Yii::$app->user->identity->isAdmin) || $model->is_correct ): ?>
    <div class="row message <?= $model->isAdminMessage ? 'admin' : '' ?> <?= !$model->is_correct ? 'incorrect' : '' ?>">
        <div class="col-md-12">
            <div class="row">
                <p class="pull-left"><b><?= $model->user->username ?></b></p>
                <?php if (!$model->isAdminMessage && $model->is_correct && Yii::$app->user->identity->isAdmin): ?>
                    <p class="pull-right">
                        <a href="<?= Url::to(['/chat/default/set-incorrect', 'id' => $key]) ?>">Пометить некорректным</a>
                    </p>
                <?php endif; ?>
            </div>
        </div>
        <p><?= Html::encode($model->text) ?></p>
        <span class="time-<?= ($index % 2 == 0 ? 'right' : 'left') ?>"><?= date('H:m', $model->created_at) ?></span>
    </div>
<?php endif; ?>
