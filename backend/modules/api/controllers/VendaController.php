<?php

namespace backend\modules\api\controllers;

use common\models\Brand;
use common\models\User;
use common\models\Vehicle;
use common\models\Venda;
use Yii;
use yii\base\Model;
use yii\filters\auth\HttpBasicAuth;
use yii\rest\ActiveController;
use yii\web\ForbiddenHttpException;
use backend\modules\api\model\Vendedor;

class VendaController extends ActiveController
{
    public ?User $user = null;

    public $modelClass = 'common\models\Venda';


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
        if ($action === 'create' or $action === 'update' or $action === 'delete') {
            throw new ForbiddenHttpException('Proibido');
        }

        if ($action === 'view') {
            $params = Yii::$app->request->queryParams;
            $id = $params["id"];
            $venda = Venda::findOne(['id' => $id]);

            if ($venda == null) {
                return new $this->modelClass;
            }

            if ($venda->idUser_buyer != $this->user->id) {
                throw new \yii\web\ForbiddenHttpException('Proibido');
            }
        }

        return new $this->modelClass;
    }

    public function actions()
    {
        $actions = parent::actions();
        unset($actions['index']);
        return $actions;
    }

    public function actionIndex()
    {
        $venda = new $this->modelClass;
        $results = $venda::find()->where(['idUser_buyer' => $this->user->id])->all();

        if ($results != null) {
            return $results;
        }

        return $venda;
    }

    public function actionInfo()
    {
        $data = [];
        $vendas = Venda::find()->where(['idUser_buyer' => $this->user->id])->all();

        if ($vendas == null) {
            return null;
        }

        foreach ($vendas as $venda) {
            $vehicle = Vehicle::findOne(['id' => $venda->idVehicle]);
            $user = User::findOne(['id' => $venda->idUser_seller]);

            //find brand, model and url
            $brand = Brand::findOne(['id' => $vehicle->idBrand]);
            $model = \common\models\Model::findOne(['id' => $vehicle->idModel]);
            $vehicle->brand = $brand->name;
            $vehicle->model = $model->name;
            $vehicle->image = $vehicle->getImageUrl();
            //

            $data[] = ['venda' => $venda, 'veiculo' => $vehicle];
        }

        return $data;
    }
}