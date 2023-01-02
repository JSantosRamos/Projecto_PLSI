<?php

namespace frontend\controllers;

use common\models\Brand;
use common\models\Model;
use common\models\Permission;
use common\models\Vendauser;
use common\models\VendauserSearch;
use yii\helpers\Url;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;

/**
 * VendauserController implements the CRUD actions for Vendauser model.
 */
class VendauserController extends Controller
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
                            'actions' => ['index', 'create', 'update', 'delete', 'view', 'confirm', 'allmodels'],
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
     *
     * @return \yii\web\Response
     */
    public function actionIndex()
    {
        return $this->redirect(Url::toRoute('site/mensagem'));

        /*  $searchModel = new VendauserSearch();
          $dataProvider = $searchModel->search($this->request->queryParams);

          return $this->render('index', [
              'searchModel' => $searchModel,
              'dataProvider' => $dataProvider,
          ]);*/
    }

    /**
     * Displays a single Vendauser model.
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
     * Creates a new Vendauser model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Vendauser();
        $model->idUser = \Yii::$app->user->id;

        $brands = Brand::find()->all(); //selectbox

        if ($this->request->isPost) {

            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
            'brands' => $brands,
        ]);
    }

    /**
     * Updates an existing Vendauser model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $brands = Brand::find()->all(); //get brands for select dropdown
        $vehicle_models = Model::find()->where(['idBrand' => $model->brand])->all(); //get models for select dropdown

        if (!Permission::allowedAction($model->idUser)) {
            $this->redirect('site/index');
        }

        if ($model->status != Vendauser::POR_VER) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
            'brands' => $brands,
            'vehicle_models' => $vehicle_models
        ]);
    }

    /**
     * Deletes an existing Vendauser model.
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

        if ($model->status != Vendauser::AGUARDANDO_RESPOSTA) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        if ($value == 'yes') {
            $model->status = Vendauser::ACEITE;
        } else {
            $model->status = Vendauser::RECUSADO;
        }

        $model->save();

        return $this->redirect(['view', 'id' => $model->id]);
    }

    /**
     * Finds the Vendauser model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Vendauser the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Vendauser::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }


    public function actionAllmodels()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $out = [];

        if (isset($_POST['depdrop_parents'])) {
            $parents = $_POST['depdrop_parents'];

            if ($parents != null) {
                $brand_id = $parents[0];
                $out = Model::find()->where(['idBrand' => $brand_id])->all();

                return ['output' => $out, 'selected' => ''];
            }
        }

        return ['output' => '', 'selected' => ''];
    }
}
