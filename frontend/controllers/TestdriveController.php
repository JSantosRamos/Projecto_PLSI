<?php

namespace frontend\controllers;

use common\models\Permission;
use common\models\Testdrive;
use common\models\TestdriveSearch;
use common\models\Vehicle;
use Yii;
use yii\db\Exception;
use yii\filters\AccessControl;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

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
                            'actions' => ['index', 'create', 'update', 'delete', 'view', 'confirm'],
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
     * Lists all Testdrive models.
     *
     * @return \yii\web\Response
     */
    public function actionIndex()
    {
        return $this->redirect(Url::toRoute('site/areapessoal'));
        /* $searchModel = new TestdriveSearch();
         $dataProvider = $searchModel->search($this->request->queryParams);

         return $this->render('index', [
             'searchModel' => $searchModel,
             'dataProvider' => $dataProvider,
         ]);*/
    }

    /**
     * Displays a single Testdrive model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);

        if (!Permission::allowedAction($model->idUser)) {
            $this->redirect('site/index');
        }

        return $this->render('view', [
            'model' => $model,
        ]);
    }

    /**
     * Creates a new Testdrive model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        if (!isset($_GET['veiculo_id'])) {
            return $this->redirect(['/vehicle/index']);
        }

        $idVeiculo = $_GET['veiculo_id'];
        $vehicle = Vehicle::findOne($idVeiculo);

        if ($vehicle == null) {
            return $this->redirect('/vehicle/index');
        }

        if ($vehicle->isActive == Vehicle::INACTIVE) {
            return $this->redirect('/vehicle/index');
        }

        $model = new Testdrive();
        $model->idUser = Yii::$app->user->id;
        $message = '';

        if ($this->request->isPost) {

            if ($model->load($this->request->post())) {

                if (!$this->validateDate($model->date)) {
                    $message = 'Data inválida';
                } else {
                    $model->save();
                    Yii::$app->session->setFlash('success', 'O seu Test-dive foi registado, pode acompanhar o processo do mesmo na sua Área Pessoal.');
                    return $this->redirect(['/vehicle/index']);
                }
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
            'idVeiculo' => $idVeiculo,
            'veiculoInfo' => $vehicle,
            'dateInvalidMessage' => $message,
        ]);
    }

    /**
     * Updates an existing Testdrive model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $idVeiculo = $model->idVehicle;

        if (!Permission::allowedAction($model->idUser)) {
            $this->redirect('site/index');
        }

        if ($model->status != Testdrive::POR_VER) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        if ($this->request->isPost && $model->load($this->request->post())) {

            $todayDate = date('d-M-Y');
            if ($model->date < $todayDate) {

                return $this->render('update', [
                    'model' => $model,
                    'idVeiculo' => $idVeiculo,
                    'dateInvalidMessage' => 'Data inválida'
                ]);
            }

            if ($model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        return $this->render('update', [
            'model' => $model,
            'idVeiculo' => $idVeiculo,
            'dateInvalidMessage' => ''
        ]);
    }

    /**
     * Deletes an existing Testdrive model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);

        if (!Permission::allowedAction($model->idUser)) {
            $this->redirect('site/index');
        }

        $model->delete();
        return $this->redirect(['index']);
    }

    public function actionConfirm($id, $value)
    {
        $model = $this->findModel($id);

        if (!Permission::allowedAction($model->idUser)) {
            $this->redirect('site/index');
        }

        if ($model->status != Testdrive::AGUARDANDO_RESPOSTA) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        if ($value == 'yes') {
            $model->status = Testdrive::ACEITE;
        } else {
            $model->status = Testdrive::RECUSADO;
        }

        $model->save();

        return $this->redirect(['view', 'id' => $model->id]);
    }

    /**
     * Finds the Testdrive model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Testdrive the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Testdrive::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    private function validateDate($date)
    {
        $todayDate = date('d-m-Y');

        $date = strtotime($date);
        $todayDate = strtotime($todayDate);


        return $date > $todayDate;
    }
}
