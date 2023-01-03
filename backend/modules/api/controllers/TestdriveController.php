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

        if (!User::isAdmin($this->user->id)) { //Verificar se é admin

            if ($action === 'index') {
                throw new \yii\web\ForbiddenHttpException('Proibido'); //user normal não tem acesso
            }

            if ($action === 'update' || $action === 'delete' || $action === 'view') {
                $params = Yii::$app->request->queryParams;
                $id = $params["id"];

                $model = Testdrive::findOne(['id' => $id]); //procurar o test solicitado no url

                if ($this->user->id != $model->idUser) { //se for de outro utilizador não tem acesso
                    throw new \yii\web\ForbiddenHttpException('Proibido');
                }

                if (($action === 'update' || $action === 'delete') && $model->status != Testdrive::POR_VER) { //se o teste já foi visto por parte do stand o utilizador apenas pode consultar
                    throw new \yii\web\ForbiddenHttpException('Proibido, não é possível realizar alterações depois de alterado pelo Stand');
                }
            }
        }
    }

    public function actions()
    {
        $actions = parent::actions();
        unset($actions['create']);
        return $actions;
    }

    //region Metodos personalizados
    public function actionMytestdrives()
    {
        return Testdrive::find()->where(['idUser' => $this->user->id])->all();
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

    //endregion
}