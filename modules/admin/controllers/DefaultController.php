<?php

namespace app\modules\admin\controllers;

use app\controllers\AppController;
use app\models\User;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;
use yii\helpers\FileHelper;
use yii\web\NotFoundHttpException;

/**
 * Default controller for the `admin` module
 */
class DefaultController extends AppController
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => 'yii\filters\VerbFilter',
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Module models.
     * @return mixed
     */
    public function actionIndex()
    {
        $users = User::find()->indexBy('id')->all();

        if (Model::loadMultiple($users, Yii::$app->request->post()) && Model::validateMultiple($users)) {
            foreach ($users as $user) {
                $user->save(false);
            }

            return $this->refresh();
        }

        $dataProvider = new ActiveDataProvider([
            'query' => User::find()->indexBy('id'),
        ]);

        $authManager = Yii::$app->getAuthManager();

        $roles = $authManager->getRoles();

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'roles' => array_reverse(ArrayHelper::getColumn($roles, 'name', false)),
        ]);
    }

    /**
     * Displays a single Module model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Module model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Module();

        if ($model->load(Yii::$app->request->post()) && $model->save(false)) {
            $generator = new Generator([
                'moduleClass' => $model->class,
                'moduleID' => $model->name,
            ]);
            if ($generator->validate()) {
                $files = $generator->generate();
                $results = '';
                $answers = [];

                if ( !empty($files) ) {
                    foreach ($files as $file) {
                        $answers[$file->id] = true;
                    }
                    $generator->save($files, $answers, $results);
                }

            }

            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Module model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Module model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     * @throws \yii\base\ErrorException
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $moduleName = $model->name;

        if ( $model->delete() ) {
            FileHelper::removeDirectory(Yii::getAlias('@app/modules/' . $moduleName));
        }

        return $this->redirect(['index']);
    }

    /**
     * Finds the Module model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Module the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Module::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
