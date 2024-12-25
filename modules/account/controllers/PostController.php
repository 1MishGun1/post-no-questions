<?php

namespace app\modules\account\controllers;

use app\models\Category;
use app\models\Post;
use app\models\Status;
use app\modules\account\models\PostSearch;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * PostController implements the CRUD actions for Post model.
 */
class PostController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Post models.
     *
     * @return string
     */
    public function actionIndex($id = null, $like = null)
    {
        $searchModel = new PostSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);
        if ($like) {
            if ($model = Post::findOne($id)) {
                switch($like) {
                    case 1:
                        $model->like++;
                        break;
                    case 0:
                        $model->dislike++;
                }
                $model->save();
            }
        }

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Post model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Post model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Post();
        $model->user_id = Yii::$app->user->id;
        $model->status_id = Status::getStatusId('Редактирование');

        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {
                if ($model->check) {
                    $model->scenario = Post::SCENARIO_COMMENT;
                    $model->category_id = null;
                } else {
                    $model->comment = null;
                }

                if ($this->request->isPjax) {
                    return $this->renderAjax('_form', [
                        'model' => $model,
                        'categoryTitle' => Category::getCategoryTitle()
                    ]);
                }

                $model->imageFile = UploadedFile::getInstance($model, 'imageFile');
                if (is_null($model->imageFile) || $model->upload()) {
                    if ($model->save(false)) {
                        return $this->redirect(['view', 'id' => $model->id]);
                    }
                }
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
            'categoryTitle' => Category::getCategoryTitle()
        ]);
    }

    /**
     * Updates an existing Post model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Post model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Post model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Post the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Post::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
