<?php

namespace backend\modules\api\controllers;

use common\models\Brand;
use common\models\Model;
use common\models\Testdrive;
use common\models\User;
use PHPUnit\Util\Test;
use Yii;
use yii\filters\auth\HttpBasicAuth;
use yii\rest\ActiveController;
use yii\web\Response;
use function PHPUnit\Framework\throwException;


class TestdriveController extends ActiveController
{
    public ?User $user = null;

    public $modelClass = 'common\models\Testdrive';

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
        if ($this->user == null) {
            throw new \yii\web\ForbiddenHttpException('Proibido');
        }

        if ($action === 'view' or $action === 'update' or $action === 'delete') {
            $params = Yii::$app->request->queryParams;
            $id = $params["id"];
            $testdrive = Testdrive::findOne(['id' => $id]);

            if ($testdrive == null) {
                return new $this->modelClass;
            }

            if ($testdrive->idUser != $this->user->id) {
                throw new \yii\web\ForbiddenHttpException('Proibido');
            }
        }

        return new $this->modelClass;
    }

    public function actions()
    {
        $actions = parent::actions();
        unset($actions['index'], $actions['create']);
        return $actions;
    }

    public function actionCreate()
    {
        $obj = \Yii::$app->request->rawBody;
        $obj = json_decode($obj);

        $testdrive = new $this->modelClass;

        $testdrive->date = $obj->date;
        $testdrive->time = $obj->time;
        $testdrive->description = $obj->description;
        $testdrive->idVehicle = $obj->idVehicle;
        $testdrive->idUser = $this->user->id;
        $testdrive->status = Testdrive::POR_VER;

        $testdrive->save();

        return $testdrive;
    }

    public function actionIndex()
    {
        $testdrive = new $this->modelClass;
        $results = $testdrive::find()->where(['idUser' => $this->user->id])->all();

        if ($results != null) {
            $testdrive = $results;
        }

        return $testdrive;
    }


    //region Metodos personalizados
    public function actionVehicletestdrivesbyid($id): array
    {
        return Testdrive::find()->where(['idVehicle' => $id])->andWhere(['idUser' => $this->user->id])->all();
    }

    public function actionDate($dd, $mm, $yy): array
    {
        $date = $dd . '-' . $mm . '-' . $yy;
        return Testdrive::find()->where(['date' => $date])->andWhere(['idUser' => $this->user->id])->all();
    }


    //endregion
}