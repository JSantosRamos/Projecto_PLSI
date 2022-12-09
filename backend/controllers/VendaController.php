<?php

namespace backend\controllers;

use common\models\User;
use common\models\UserSearch;
use common\models\Vehicle;
use common\models\VehicleSearch;
use common\models\Venda;
use common\models\VendaSearch;
use yii\filters\AccessControl;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * VendaController implements the CRUD actions for Venda model.
 */
class VendaController extends Controller
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
                            'actions' => ['index', 'view', 'create', 'viewdetail'],
                            'allow' => true,
                            'roles' => ['employee'],
                        ],
                        [
                            'actions' => ['update'],
                            'allow' => true,
                            'roles' => ['manager'],
                        ],
                        [
                            'actions' => ['delete'],
                            'allow' => true,
                            'roles' => ['admin'],
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
     * Lists all Venda models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new VendaSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Venda model.
     * @param int $id ID
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $idUser = \Yii::$app->user->id;
        $model = $this->findModel($id);

        if (User::isEmployee($idUser)) {
            if ($model->idUser_seller != $idUser) {
                return $this->redirect(Url::toRoute('venda/index'));
            }
        }

        return $this->render('view', [
            'model' => $model,
        ]);
    }

    /**
     * Creates a new Venda model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Venda();
        $searchVehicle = new VehicleSearch();
        $searchUser = new UserSearch();
        $message = "";

        $dataVehicle = $searchVehicle->search($this->request->queryParams);

        $dataUser = $searchUser->search($this->request->queryParams);

        if ($this->request->isPost) {
            $model->idUser_seller = \Yii::$app->user->id;

            if ($model->load($this->request->post())) {

                $vehicle = Vehicle::findOne($model->idVehicle);

                if ($vehicle == null || $vehicle->status == Vehicle::STATUS_SOLD) {
                    $message = 'O veículo indicado não existe ou já está vendido';

                    return $this->render('create', [
                        'model' => $model, 'searchVehicle' => $searchVehicle, 'dataVehicle' => $dataVehicle, 'searchUser' => $searchUser, 'dataUser' => $dataUser, 'message' => $message,
                    ]);
                }

                if ($model->save()) {

                    $vehicle->status = Vehicle::STATUS_SOLD;
                    $vehicle->save();

                    return $this->redirect(['view', 'id' => $model->id]);
                }
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
            'searchVehicle' => $searchVehicle,
            'dataVehicle' => $dataVehicle,
            'searchUser' => $searchUser,
            'dataUser' => $dataUser,
            'message' => $message,
        ]);
    }

    /**
     * Updates an existing Venda model.
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
     * Deletes an existing Venda model.
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

    public function actionViewdetail($id)
    {

        $venda = Venda::findOne($id);

        $vendedor = User::findOne($venda->idUser_seller);
        $cliente = User::findOne($venda->idUser_buyer);
        $veiculo = Vehicle::findOne($venda->idVehicle);

        return $this->render('viewdetail', [
            'venda' => $venda,
            'vendedor' => $vendedor,
            'cliente' => $cliente,
            'veiculo' => $veiculo,
        ]);
    }

    /**
     * Finds the Venda model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Venda the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Venda::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
