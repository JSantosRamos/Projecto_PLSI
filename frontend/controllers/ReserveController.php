<?php

namespace frontend\controllers;

use common\models\Reserve;
use common\models\ReserveSearch;
use common\models\Vehicle;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * ReserveController implements the CRUD actions for Reserve model.
 */
class ReserveController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'access' => [
                    'class' => AccessControl::class,
                    'rules' => [
                        [
                            'actions' => ['create', 'view', 'download'],
                            'allow' => true,
                            'roles' => ['@'],
                        ],
                    ],
                ],
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
     * Lists all Reserve models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new ReserveSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Reserve model.
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
     * Creates a new Reserve model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {

        if (!isset($_GET['veiculo_id'])) {
            return $this->redirect(['/vehicle/index']);
        }

        $idVehicle = $_GET['veiculo_id'];
        $vehicle = Vehicle::findOne($idVehicle);

        if($vehicle->status == Vehicle::STATUS_RESERVED){
            Yii::$app->session->setFlash('warning', 'Não é possível, de momento este veículo encontra-se reservado.');
            return $this->redirect(['/vehicle/view', 'id' => $vehicle->id]);
        }

        if ($vehicle == null) {
            return $this->redirect('/vehicle/index');
        }

        if ($vehicle->isActive == Vehicle::INACTIVE) {
            return $this->redirect('/vehicle/index');
        }

        $model = new Reserve();
        $model->idUser = Yii::$app->user->id;
        $model->idVehicle = $idVehicle;

        $model->ccFile = UploadedFile::getInstance($model, 'ccFile');

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {

                $vehicle->status = Vehicle::STATUS_RESERVED;
                $vehicle->save();

                Yii::$app->session->setFlash('success', 'A sua reserva foi efectuada, tem 48h para se dirigir ao Stand Auto.');
                return $this->redirect(['/site/index']);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
            'vehicle' => $vehicle,
        ]);
    }

    /**
     * Updates an existing Reserve model.
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
     * Deletes an existing Reserve model.
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
     * Finds the Reserve model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Reserve the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Reserve::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionDownload($file)
    {
        $path = \Yii::getAlias('@backend/web/storage' . $file);

        return \Yii::$app->response->sendFile($path);
    }
}
