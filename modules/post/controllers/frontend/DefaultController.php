<?php

namespace app\modules\post\controllers\frontend;

use app\controllers\AppController;

use app\modules\post\models\Post;
use yii\caching\DbDependency;
use yii\data\Pagination;

/**
 * Default controller for the `post` module
 */
class DefaultController extends AppController
{
    public function behaviors() {
        return [
//            [
//                'class' => 'yii\filters\PageCache',
//                'only' => ['index'],
//                'duration' => 0,
//                'dependency' => [
//                    'class' => 'yii\caching\DbDependency',
//                    'sql' => 'SELECT COUNT(*) FROM post',
//                ],
//            ],
//            [
//                'class' => 'yii\filters\HttpCache',
//                'only' => ['index'],
//                'lastModified' => function ($action, $params) {
//                    $q = new \yii\db\Query();
//                    return $q->from('post')->max('updated_at');
//                },
//            ],
        ];
    }

    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        $query = Post::find();

        $dependency = new DbDependency([
            'sql' => $query->select(['COUNT(*)', 'MAX(updated_at)'])->createCommand()->getRawSql(),
        ]);

        $pages = new Pagination([
            'totalCount' => Post::find()->count(),
            'pageSize' => 2,
            'pageSizeParam' => false,
            'forcePageParam' => false,
        ]);

        $key = ['posts', $pages->offset, $pages->limit];

        $models = $this->cache->getOrSet($key, function() use ($pages) {
            return Post::find()->offset($pages->offset)->limit($pages->limit)->all();
        }, 0, $dependency);

        return $this->render('index', [
            'models' => $models,
            'pages' => $pages,
        ]);
    }

    public function actionView($id)
    {
        $model = Post::findOne($id);

        return $this->render('view', [
            'model' => $model,
        ]);
    }
}
