<?php
/**
 * This is the template for generating a controller class within a module.
 */

/* @var $this yii\web\View */
/* @var $generator yii\gii\generators\module\Generator */
/* @var $template string */

echo "<?php\n";
?>

namespace app\modules\<?= $generator->moduleID ?>\controllers\<?= $template ?>;

use app\controllers\AppController;

/**
 * Default controller for the `<?= $generator->moduleID ?>` module
 */
class DefaultController extends AppController
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }
}
