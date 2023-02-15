<?php

namespace backend\modules\api\controllers;

use backend\modules\api\model\Veiculo;
use common\models\Reserve;
use common\models\Testdrive;
use common\models\User;
use common\models\Vehicle;
use Yii;
use yii\base\Exception;
use yii\filters\auth\HttpBasicAuth;
use yii\helpers\FileHelper;
use yii\rest\ActiveController;
use yii\web\ForbiddenHttpException;
use yii\web\UploadedFile;

class ReserveController extends ActiveController
{
    public $modelClass = 'common\models\Reserve';
    public ?User $user = null;

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
        return "";
    }

    public function checkAccess($action, $model = null, $params = [])
    {
        if ($action === 'update' or $action === 'delete') {
            throw new ForbiddenHttpException('Proibido');
        }
    }

    public function actions()
    {
        $actions = parent::actions();
        unset($actions['create']);
        return $actions;
    }

    public function actionCreate()
    {
        $obj = \Yii::$app->request->rawBody;
        $obj = json_decode($obj);

        $reserva = new Reserve();

        $reserva->idUser = $this->user->id;
        $reserva->idVehicle = $obj->idVehicle;
        $reserva->number = $obj->number;
        $reserva->nif = $obj->nif;
        $reserva->morada = $obj->morada;

        //criar um caminho
        $path = '/reserve/' . Yii::$app->security->generateRandomString();
        $output_file = Yii::getAlias('@backend/web/storage' . $path);

        //criar uma pasta
        $file = null;
        if (FileHelper::createDirectory($output_file)) {
            $file = $output_file . '/' . 'cc.JPG';
        }

        //se a pasta foi criada cria um ficheiro vazio
        if ($file != null) {
            $handle = fopen($file, 'w') or die("Cannot open file: $file");
            fclose($handle);

            $this->base64ToImage($obj->image, $file);
            $reserva->cc = $path . '/' . 'cc.JPG';
        }

        $reserva->save();

        //veículo passa a reservado
        $vehicle = Vehicle::findOne(['id' => $reserva->idVehicle]);
        $vehicle->status = Vehicle::STATUS_RESERVED;
        $vehicle->save();

        return $reserva;
    }

    function base64ToImage($base64_string, $output_file)
    {
        $file = fopen($output_file, "wb");

        // Convert base64 string to binary data
        $decoded_string = base64_decode($base64_string);

        // Write binary data to file
        fwrite($file, $decoded_string);
        fclose($file);
    }
}