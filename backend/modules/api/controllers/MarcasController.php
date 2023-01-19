<?php

namespace backend\modules\api\controllers;

use common\models\Brand;
use common\models\Model;
use common\models\User;
use yii\filters\auth\HttpBasicAuth;
use yii\rbac\CheckAccessInterface;
use yii\rest\ActiveController;
use yii\web\ForbiddenHttpException;
use yii\web\Response;
use function PHPUnit\Framework\throwException;


class MarcasController extends ActiveController
{
    public $modelClass = 'common\models\Brand';
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
        if ($action === 'update' or $action === 'create' or $action === 'delete') {
            throw new ForbiddenHttpException('Proibido');
        }
    }
}