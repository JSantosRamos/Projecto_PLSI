<?php

namespace backend\modules\api\controllers;

use backend\modules\api\model\Imagem;
use backend\modules\api\model\Veiculo;
use common\models\Brand;
use common\models\Image;
use common\models\Model;
use common\models\User;
use common\models\Vehicle;
use common\models\Venda;
use yii\filters\auth\HttpBasicAuth;
use yii\rest\ActiveController;
use yii\web\ForbiddenHttpException;
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
        if ($action === 'update' or $action === 'create' or $action === 'delete') {
            throw new ForbiddenHttpException('Proibido');
        }
    }

    //Alterar a action index de origem
    public function actions()
    {
        $actions = parent::actions();
        unset($actions['index']);
        return $actions;
    }

    public function actionIndex() //return todos os veiculos retorna os nomes para marca e modelo para quem consome a api não o ter de fazer 2 chamadas separadas a marcas e modelos.
    {
        $vehicles = Vehicle::find()->where(['status' => 'Disponivel', 'isActive' => 1])->all(); // isActive -> Com visíbilidade publica.

        if ($vehicles == null) {
            return $vehicles;
        }

        $veiculosDTO = [];
        foreach ($vehicles as $veh) {
            $vehImagens = [];

            $brand = Brand::find()->where(['id' => $veh->idBrand])->one();
            $model = Model::find()->where(['id' => $veh->idModel])->one();
            $imagens = Image::find()->where(['idVehicle' => $veh->id])->all();

            if ($imagens != null) {
                foreach ($imagens as $i) {
                    $newImage = $i->getImageUrl(); //imagens do veiculo
                    $vehImagens[] = $newImage;
                }
            }

            //Atribui ao veiculo os novos campos
            $brand = $brand->name;
            $model = $model->name;
            $url = $veh->getImageUrl();


            $newVeiculo = new Veiculo($veh->id, $brand, $model, $veh->serie, $veh->type, $veh->fuel, $veh->mileage, $veh->engine, $veh->color, $veh->description, $veh->year, $veh->doorNumber, $veh->transmission,
                $veh->price, $url, $veh->title, $veh->plate, $veh->cv, $vehImagens);

            $veiculosDTO[] = $newVeiculo;
        }

        return $veiculosDTO;
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

        $brand = Brand::findOne(['id' => $id]);
        $vehicles = $model::find()->where(['idBrand' => $id])->all();

        return ['marca' => $brand->name, 'veiculos' => $vehicles];
    }

    public function actionModel($id)
    {
        $modelo = Model::findOne(['id' => $id]);
        $vehicles = new $this->modelClass;

        return ['modelo' => $modelo->name, 'veiculos' => $vehicles];
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

    public function actionImagens($id)
    {
        $model = new $this->modelClass();

        $imagens = Image::find()->where(['idVehicle' => $id])->all();
        if ($imagens != null) {

            $imagens_veh = [];
            foreach ($imagens as $image) {

                $url = $image->getImageUrl();
                $image_veh = new Imagem($image->id, $url, $id);

                $imagens_veh[] = $image_veh;
            }
        }

        return $imagens != null ? ['Images' => $imagens_veh] : $model;
    }

    //endregion
}