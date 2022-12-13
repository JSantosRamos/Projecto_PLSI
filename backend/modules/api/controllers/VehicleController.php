<?php

namespace backend\modules\api\controllers;

use yii\rest\ActiveController;
use function PHPUnit\Framework\throwException;


class VehicleController extends ActiveController
{
    public $modelClass = 'common\models\Vehicle';

    public function actionVehiclebybrand($brand)
    {

        $model = new $this->modelClass();

        $vehicles = $model::find()->where(['brand' => $brand])->all();

        return $vehicles;
    }

    public function actionAddvehicle($obj)
    {

        $model = new $this->modelClass();

        $vehicles = $model::find()->where(['brand' => $brand])->all();

        return $vehicles;
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