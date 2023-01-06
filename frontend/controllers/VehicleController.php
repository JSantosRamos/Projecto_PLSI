<?php

namespace frontend\controllers;

use common\models\Brand;
use common\models\Image;
use common\models\Model;
use common\models\Vehicle;
use common\models\VehicleSearch;
use Yii;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;

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
        $searchModel = new VehicleSearch();
        $dataProvider = $searchModel->search($this->request->queryParams, true);
        $model = new Vehicle();
        $brands = Brand::find()->all();

        $vehicles_models = "";
        if(!empty($searchModel->idBrand)){

            $vehicles_models = Model::find()->where(['idBrand' => $searchModel->idBrand])->all();
        }

        $vehicles = Vehicle::find()->where(['isActive' => 1])->all();

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'vehicles' => $vehicles,
            'model' => $model,
            'brands' => $brands,
            'vehicles_models' => $vehicles_models,
        ]);
    }

    /**
     * Displays a single Vehicle model.
     * @param int $id ID
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $vehicle = Vehicle::findOne($id);

        if($vehicle->isActive == Vehicle::INACTIVE){
            return $this->redirect('index');
        }

        $brand = $vehicle->idBrand;

        $items = Vehicle::find()->where(['isActive' => 1])->andWhere(['idBrand'=>$brand])->all();
        $items = array_slice($items, 0, 3);

        $vehicle_imagens = Image::find()->where(['idVehicle' => $id])->all();

        return $this->render('view', [
            'model' => $this->findModel($id),
            'items' => $items,
            'vehicle_imagens' => $vehicle_imagens,
        ]);
    }

    /**
     * Creates a new Vehicle model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    /*public function actionCreate()
    {
        $model = new Vehicle();

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
     * Updates an existing Vehicle model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    /*public function actionUpdate($id)
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
     * Deletes an existing Vehicle model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
  /*  public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }
  */

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
