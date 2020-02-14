<?php
/**
 * @var $model app\modules\post\models\Post
 * @var $this yii\web\View
 */

use yii\helpers\Html;
use yii\helpers\Url;

?>

<div class="jumbotron">
    <h1>Congratulations!</h1>

    <p class="lead"><?= $model->content ?></p>
    <?php if (!empty(Yii::$app->request->referrer)): ?>
        <p><?= Html::a('Go back', Yii::$app->request->referrer) ?></p>
    <?php endif; ?>
</div>
