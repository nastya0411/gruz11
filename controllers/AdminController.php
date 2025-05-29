<?php

namespace app\controllers;

use app\models\Order;
use app\models\AdminSearch;
use app\models\Status;
use PHPUnit\TextUI\Configuration\Variable;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\VarDumper;

/**
 * AdminController implements the CRUD actions for Order model.
 */
class AdminController extends Controller
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
     * Lists all Order models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new AdminSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Order model.
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
     * Creates a new Order model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Order();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Order model.
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

    public function actionWork($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost) {
            $model->status_id = Status::getStatusId('В работе');
            $model->user_id = Yii::$app->user->id;
            if ($model->save()) {
                Yii::$app->session->setFlash('info', 'Заявка принята в работу!');
                return $this->redirect(['view', 'id' => $model->id]);
            } 
        }
    }

    public function actionApply($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost) {
            $model->status_id = Status::getStatusId('Выполнена');
            $model->user_id = Yii::$app->user->id;
            if ($model->save()) {
                Yii::$app->session->setFlash('info', 'Заявка успешно выполнена!');
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }
    }

        public function actionCancel($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost) {
            $model->status_id = Status::getStatusId('Отменена');
            $model->user_id = Yii::$app->user->id;
            if ($model->save()) {
                Yii::$app->session->setFlash('info', 'Заявка отменена!');
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }
    }


    /**
     * Deletes an existing Order model.
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
     * Finds the Order model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Order the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Order::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    
    public function beforeAction($action)
    {

        if (!parent::beforeAction($action)) {
            return false;
        }

        $this->view->registerCss('body{background-image:url("/web/img/5.png")}');

        return true; 
    }
}
