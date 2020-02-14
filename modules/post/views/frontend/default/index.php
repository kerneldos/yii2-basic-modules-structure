<?php
/**
 * @var $models app\modules\post\models\Post
 */

use yii\helpers\Html;
use yii\helpers\Url;

?>

<?php foreach (array_chunk($models, 3) as $row): ?>
    <div class="row">
        <?php foreach ($row as $post): ?>
            <div class="col-md-4">
                <h1>Post #<?= $post->id ?></h1>
                <p><?= $post->content ?></p>
                <p><?= Html::a('View', Url::to(['/post/default/view', 'id' => $post->id])) ?></p>
            </div>
        <?php endforeach; ?>
    </div>
<?php endforeach; ?>
