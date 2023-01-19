<?php

namespace backend\controllers;

use common\models\Reserve;
use common\models\User;
use common\models\UserSearch;
use common\models\Vehicle;
use common\models\VehicleSearch;
use common\models\Venda;
use common\models\VendaSearch;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

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
                            'actions' => ['delete', 'update'],
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

        $users = User::find()->where(['isEmployee' => 1])->all();
        $vehicles = Vehicle::find()->where(['status' => 'Vendido'])->all();

        $users = ArrayHelper::map($users, 'id', 'email');
        $vehicles = ArrayHelper::map($vehicles, 'id', 'plate');

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'users' => $users,
            'vehicles' => $vehicles,
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

        if (User::isEmployee($idUser) && $model->idUser_seller != $idUser) {
            return $this->redirect(Url::toRoute('venda/index'));
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

        $users = User::find()->where(['isEmployee' => 0])->all(); //selectbox users
        $vehicles = Vehicle::find()->where(['status' => Vehicle::STATUS_AVAILABLE])->orWhere(['status' => Vehicle::STATUS_RESERVED])->all(); //selectbox veiculos

        $dataVehicle = $searchVehicle->search($this->request->queryParams);
        $dataUser = $searchUser->search($this->request->queryParams, true);

        if ($this->request->isPost) {
            $model->idUser_seller = \Yii::$app->user->id;

            if ($model->load($this->request->post())) {

                $vehicle = Vehicle::findOne($model->idVehicle);

                if ($vehicle == null || $vehicle->status == Vehicle::STATUS_SOLD) { //já não faz sentido com a selectbox veiculos... mas é uma validação extra.
                    $message = 'O veículo indicado não existe ou já está vendido';

                    return $this->render('create', [
                        'model' => $model, 'searchVehicle' => $searchVehicle, 'dataVehicle' => $dataVehicle, 'searchUser' => $searchUser, 'dataUser' => $dataUser, 'message' => $message, 'users' => $users, 'vehicles' => $vehicles,
                    ]);
                }

                if ($vehicle->status == Vehicle::STATUS_RESERVED) {
                    $reserve = Reserve::findOne(['idVehicle' => $vehicle->id]);
                    $nif = $reserve->nif;

                    if ($nif != $model->nif) {
                        $message = 'O veículo já está reservado para outro cliente';
                        return $this->render('create', [
                            'model' => $model, 'searchVehicle' => $searchVehicle, 'dataVehicle' => $dataVehicle, 'searchUser' => $searchUser, 'dataUser' => $dataUser, 'message' => $message, 'users' => $users, 'vehicles' => $vehicles,
                        ]);
                    }
                }

                if ($model->save()) {

                    $vehicle->status = Vehicle::STATUS_SOLD;
                    $vehicle->isActive = Vehicle::INACTIVE;
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
            'users' => $users,
            'vehicles' => $vehicles,
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
        $users = User::find()->where(['isEmployee' => 0])->all(); //selectbox users
        $message = '';

        $model = $this->findModel($id);
        $vehicles = Vehicle::find()->where(['id' => $model->idVehicle])->all(); //selectbox veiculos, só devolve um mas é feito com o metedo all para devolver um array

        $old_idVehicle = $model->idVehicle;

        if ($this->request->isPost && $model->load($this->request->post())) {

            if ($old_idVehicle != $model->idVehicle) { //verificar se a alteração na venda é do veiculo.

                $old_vehicle = Vehicle::findOne($old_idVehicle);
                $new_vehicle = Vehicle::findOne($model->idVehicle);

                if ($new_vehicle == null || $new_vehicle->status == Vehicle::STATUS_SOLD) { //verificar se o veiculo é valido.
                    $message = 'O veículo indicado não existe ou já está vendido';

                    return $this->render('update', [
                        'model' => $model, 'message' => $message, 'users' => $users, 'vehicles' => $vehicles,
                    ]);
                }

                if ($model->save()) {
                    //se for vai remover o antigo do estado vendido e atualizar o novo.
                    $new_vehicle->status = Vehicle::STATUS_SOLD;
                    $new_vehicle->isActive = Vehicle::INACTIVE;

                    $old_vehicle->status = Vehicle::STATUS_AVAILABLE;

                    $new_vehicle->save();
                    $old_vehicle->save();
                }
            } else {
                $model->save();
            }

            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
            'users' => $users,
            'vehicles' => $vehicles,
            'message' => $message,
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
        $model = $this->findModel($id);

        if ($model->delete()) {
            $vehicle = Vehicle::findOne($model->idVehicle);

            if ($vehicle != null) {
                $vehicle->status = Vehicle::STATUS_AVAILABLE;
                $vehicle->save();
            }
        }

        return $this->redirect(['index']);
    }

    public function actionViewdetail($id)
    {
        $idUser = \Yii::$app->user->id;
        $venda = Venda::findOne($id);

        if (User::isEmployee($idUser) && $venda->idUser_seller != $idUser) {
            return $this->redirect(Url::toRoute('venda/index'));
        }

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
