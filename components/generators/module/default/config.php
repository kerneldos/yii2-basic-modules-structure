<?php
/* @var $this yii\web\View */
/* @var $generator yii\gii\generators\module\Generator */
/* @var $template string */

echo "<?php\n";
?>

return [
    'controllerNamespace' => 'app\modules\<?= $generator->moduleID ?>\controllers\<?= $template ?>',
    'viewPath' => '@app/modules/<?= $generator->moduleID ?>/views/<?= $template ?>',
];
