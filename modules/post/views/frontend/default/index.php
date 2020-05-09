<?php
/**
 * @var app\modules\post\models\Post[] $models
 * @var \yii\data\Pagination $pages
 */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\LinkPager;

?>

<?php foreach (array_chunk($models, 3) as $row): ?>
    <div class="row">
        <?php foreach ($row as $post): ?>
            <div class="col-md-4">
                <h1>Post #<?= $post->id ?></h1>
                <p><?= $post->content ?></p>
                <p><?= Html::a('View', Url::to(['default/view', 'id' => $post->id])) ?></p>
            </div>
        <?php endforeach; ?>
    </div>
<?php endforeach; ?>

<div class="row">
    <?= LinkPager::widget([
        'pagination' => $pages,
        'registerLinkTags' => true,
        'disableCurrentPageButton' => true,
    ]); ?>
</div>
