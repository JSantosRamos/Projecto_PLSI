<?php

namespace frontend\controllers;

use common\models\Permission;
use common\models\Testdrive;
use common\models\TestdriveSearch;
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
                            'actions' => ['index', 'create', 'update', 'delete', 'view'],
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
        return $this->redirect(Url::toRoute('site/mensagem'));
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
        if (!isset($_GET['veiculo_id']) && !isset($_GET['veiculo_info'])) {
            return $this->redirect(['/vehicle/index']);
        }

        $idVeiculo = $_GET['veiculo_id'];
        $veiculoInfo = $_GET['veiculo_info'];
        $sessionUserId = Yii::$app->user->getId();

        $model = new Testdrive();

        if ($this->request->isPost) {

            if ($model->load($this->request->post())) {

                $todayDate = date('d-M-Y');

                if ($model->date < $todayDate) {

                    return $this->render('create', [
                        'model' => $model,
                        'idUser' => $sessionUserId,
                        'idVeiculo' => $idVeiculo,
                        'veiculoInfo' => $veiculoInfo,
                        'dateInvalidMessage' => 'Data inválida'
                    ]);
                }

              if($model->save()){
                  return $this->redirect(['/vehicle/index']);
              }

            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
            'idUser' => $sessionUserId,
            'idVeiculo' => $idVeiculo,
            'veiculoInfo' => $veiculoInfo,
            'dateInvalidMessage' => ''
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
        $idUser = $model->idUser;
        $idVeiculo = $model->idVehicle;

        if (!Permission::allowedAction($model->idUser)) {
            $this->redirect('site/index');
        }

        if($model->status != Testdrive::POR_VER){
            return $this->redirect(['view', 'id' => $model->id]);
        }

        if ($this->request->isPost && $model->load($this->request->post())) {

            $todayDate = date('d-M-Y');
            if ($model->date < $todayDate) {

                return $this->render('update', [
                    'model' => $model,
                    'idUser' => $idUser,
                    'idVeiculo' => $idVeiculo,
                    'dateInvalidMessage' => 'Data inválida'
                ]);
            }

            if($model->save()){
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        return $this->render('update', [
            'model' => $model,
            'idUser' => $idUser,
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
}
