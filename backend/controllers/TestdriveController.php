<?php

namespace backend\controllers;

use common\models\Testdrive;
use common\models\TestdriveSearch;
use common\models\User;
use common\models\Vehicle;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use const http\Client\Curl\VERSIONS;

/**
 * TestdriveController implements the CRUD actions for Testdrive model.
 */
class TestdriveController extends Controller
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
                            'actions' => ['index', 'view', 'update', 'create', 'delete'],
                            'allow' => true,
                            'roles' => ['manager'],
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
     * Lists all Testdrive models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new TestdriveSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Testdrive model.
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
     * Creates a new Testdrive model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Testdrive();
        $users = User::find()->where(['isEmployee' => 0])->all();
        $vehicles = Vehicle::find()->where(['status' => Vehicle::STATUS_AVAILABLE])->all();

        if ($this->request->isPost && $model->load($this->request->post())) {

            if (!$this->validateDate($model->date)) {

                return $this->render('create', [
                    'model' => $model,
                    'dateInvalidMessage' => 'Data inválida', 'users' => $users, 'vehicles' => $vehicles,
                ]);
            }

            if ($model->save()) {
                return $this->redirect(['index']);
            }

        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
            'dateInvalidMessage' => '',
            'users' => $users,
            'vehicles' => $vehicles,
        ]);
    }

    /**
     * Updates an existing Testdrive model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public
    function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $users = User::find()->where(['isEmployee' => 0])->all();
        $vehicles = Vehicle::find()->where(['status' => Vehicle::STATUS_AVAILABLE])->all();

        $vehicle = Vehicle::findOne(['id' => $model->idVehicle]);
        if ($vehicle->status == Vehicle::STATUS_SOLD) { //Se o veiculo for vendido depois do teste ser marcado o teste já não tinha o id do veiculo no update e passava a não ser possivel marcar o estado do teste.
            $vehicles[] = $vehicle;
        }

        if ($this->request->isPost && $model->load($this->request->post())) {

            if ($this->validateDate($model->date)) {
                $model->save();
                return $this->redirect(['index']);

            } else {

                return $this->render('update', [
                    'model' => $model,
                    'dateInvalidMessage' => 'Data inválida', 'users' => $users, 'vehicles' => $vehicles,
                ]);
            }
        }

        return $this->render('update', [
            'model' => $model,
            'users' => $users,
            'vehicles' => $vehicles,
            'dateInvalidMessage' => '',
        ]);
    }


    /**
     * Deletes an existing Testdrive model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public
    function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Testdrive model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Testdrive the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected
    function findModel($id)
    {
        if (($model = Testdrive::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    private
    function validateDate($date)
    {
        $todayDate = date('d-m-Y');

        $date = strtotime($date);
        $todayDate = strtotime($todayDate);

        return $date > $todayDate;
    }
}
