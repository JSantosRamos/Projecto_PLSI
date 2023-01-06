<?php

namespace backend\modules\api\controllers;

use common\models\Brand;
use common\models\Model;
use common\models\User;
use common\models\Vehicle;
use yii\filters\auth\HttpBasicAuth;
use yii\rest\ActiveController;
use yii\web\Response;
use function PHPUnit\Framework\throwException;


class VehicleController extends ActiveController
{
    public $modelClass = 'common\models\Vehicle';

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['authenticator'] = [
            'class' => HttpBasicAuth::className(),
            'auth' => [$this, 'auth']
        ];
        return $behaviors;
    }

    public function auth($email, $password)
    {
        $user = User::findByEmail($email);
        if ($user && $user->validatePassword($password)) {

            $this->user = $user;
            return $user;
        }

        throw new \yii\web\ForbiddenHttpException('No authentication');
    }

    public function checkAccess($action, $model = null, $params = [])
    {
        //validar se existe user
        if ($this->user == null) {
            throw new \yii\web\ForbiddenHttpException('Proibido');
        }

        //validar se user é admin
        if (!User::isAdmin($this->user->id)) {
            throw new \yii\web\ForbiddenHttpException('Proibido');
        }
    }

    //Alterar as action criadas de origem
    public function actions()
    {
        $actions = parent::actions();
        unset($actions['index'], $actions['delete']);
        return $actions;
    }

    public function actionIndex() //return todos os veiculos retorna os nomes para marca e modelo para quem consome a api não o ter de fazer 2 chamadas separadas a marcas e modelos.
    {
        $vehicles = Vehicle::find()->where(['status' => 'Disponivel', 'isActive' => 1])->all();

        foreach ($vehicles as $veh) {
            $brand = Brand::find()->select('name')->where(['id' => $veh->idBrand])->one();
            $model_veh = Model::find()->select('name')->where(['id' => $veh->idModel])->one();

            //obtem a imagem e convert para base64
            $url = $veh->getImageUrl();
            $data = file_get_contents($url);
            $imageBase64 = base64_encode($data);

            //Atribui ao veiculo os novos campos
            $veh->brand = $brand["name"];
            $veh->model = $model_veh["name"];
            //$veh->image = $url;
            $veh->image = $imageBase64;
        }

        return $vehicles;
    }


    // region Metodos Personalizados

    public function actionTotal()
    {
        $model = new $this->modelClass;

        $total = $model::find()->count();
        return ['total' => $total];
    }

    public function actionBrand($id)
    {
        $model = new $this->modelClass;

        return $model::find()->where(['idBrand' => $id])->all();
    }

    public function actionModel($id)
    {
        $model = new $this->modelClass;

        return $model::find()->where(['idModel' => $id])->all();
    }

    public function actionStatus($id)
    {
        $model = new $this->modelClass;
        $vehicle = $model::find()->select(['status'])
            ->where(['id' => $id])->one(); //objeto json

        return $vehicle;
    }

    public function actionPrice($id)
    {
        $model = new $this->modelClass;
        $vehicle = $model::find()->select(['price'])
            ->where(['id' => $id])->one(); //objeto json
        return $vehicle;
    }

    //endregion


    public function actionPreco($id)
    {
        $vehicleModel = new $this->modelClass;
        $rec = $vehicleModel::find()->select(['price'])
            ->where(['id' => $id])->one(); //objeto json
        return $rec;
    }

    public function actionPrecobrand($idBrand)
    {
        $vehicleModel = new $this->modelClass;
        $recs = $vehicleModel::find()->select(['price'])
            ->where(['idBrand' => $idBrand])->all(); //array
        return $recs;
    }

    public function actionVehiclebybrand($brand)
    {

        $model = new $this->modelClass();

        return $model::find()->where(['brand' => $brand])->all();
    }

    /* public function actionPutvehiclebyid($id)
     {

         $model = new $this->modelClass();

         $vehicle = $model::findOne(['id' => $id]);


         if ($vehicle) {

             $obj = \Yii::$app->request->rawBody;

             $array = json_decode($obj);
             echo '<pre>';
             var_dump($array->brand);
             echo'</pre>';
             exit;

             return $object;
         } else {
             throw new \yii\web\NotFoundHttpException("Veículo não encontrado");

         }
     }
 */

}