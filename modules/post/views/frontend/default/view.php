<?php
/**
 * @var $model app\modules\post\models\Post
 * @var $this yii\web\View
 */

use yii\helpers\Html;

$query = $model::find()->select('updated_at')->where(['id' => $model->id]);

$dependency = [
    'class' => 'yii\caching\DbDependency',
    'sql' => $query->createCommand()->getRawSql(),
];

?>

<?php if ($this->beginCache(['post', $model->id], ['dependency' => $dependency])): ?>

    <div class="jumbotron">
        <h1>Congratulations!</h1>

        <p class="lead"><?= $model->content ?></p>
        <?php if (!empty(Yii::$app->request->referrer)): ?>
            <p><?= Html::a('Go back', Yii::$app->request->referrer) ?></p>
        <?php endif; ?>
    </div>

    <?php $this->endCache(); ?>
<?php endif; ?>