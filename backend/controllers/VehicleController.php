<?php

namespace backend\controllers;

use common\models\Brand;
use common\models\Image;
use common\models\ImageSearch;
use common\models\Model;
use common\models\Vehicle;
use common\models\VehicleSearch;
use Throwable;
use Yii;
use yii\data\ActiveDataProvider;
use yii\data\Pagination;
use yii\db\Query;
use yii\db\StaleObjectException;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;
use yii\web\UploadedFile;

/**
 * VehicleController implements the CRUD actions for Vehicle model.
 */
class VehicleController extends Controller
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
                            'actions' => ['index', 'view', 'allmodels'],
                            'allow' => true,
                            'roles' => ['employee'],
                        ],
                        [
                            'actions' => ['create', 'update'],
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
     * Lists all Vehicle models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $brands = Brand::find()->all();
        $searchModel = new VehicleSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'brands' => $brands,
        ]);
    }

    /**
     * Displays a single Vehicle model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {

        $query = Image::find()->where(['idVehicle' => $id]);
        $imagens = new ActiveDataProvider([
            'query' => $query,
            'pagination' => ['pageSize' => 4]
        ]);

        return $this->render('view', [
            'model' => $this->findModel($id),
            'imagens' => $imagens,
        ]);
    }

    /**
     * Creates a new Vehicle model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|Response
     */
    public function actionCreate()
    {
        $model = new Vehicle();
        $model->imageFile = UploadedFile::getInstance($model, 'imageFile');

        $brands = Brand::find()->all(); //get brands for select dropdown
        $vehicle_models = Model::find()->all(); //get models for select dropdown

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
            'vehicle_models' => $vehicle_models,
        ]);
    }

    /**
     * Updates an existing Vehicle model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $brands = Brand::find()->all(); //get brands for select dropdown
        $vehicle_models = Model::find()->where(['idBrand' => $model->idBrand])->all(); //get models for select dropdown

        $model->imageFile = UploadedFile::getInstance($model, 'imageFile');

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
     * Deletes an existing Vehicle model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return string|Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);

        $vehImagens = Image::find()->where(['idVehicle' => $id])->all(); //limpa todas as imagens do veiculo antes de apagar
        foreach ($vehImagens as $image) {
            $image->delete();
        }

        try {
            $model->delete(); //erro se o veiculo estiver vendido

        } catch (Throwable $e) {

            return $this->redirect(['view', 'id' => $model->id, 'erro_delete' => 'true']);
        }

        return $this->redirect(['index']);
    }

    /**
     * Finds the Vehicle model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Vehicle the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Vehicle::findOne(['id' => $id])) !== null) {
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
