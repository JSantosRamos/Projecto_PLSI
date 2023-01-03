<?php

namespace backend\modules\api\controllers;

use APIResponse;
use common\models\LoginForm;
use common\models\User;
use yii\filters\auth\HttpBasicAuth;
use yii\rest\ActiveController;
use function PHPUnit\Framework\throwException;


class UserController extends ActiveController
{
    public ?User $user = null;

    public $modelClass = 'common\models\User';

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

    //Override metodo create user, para guardar a password com formato hash e atribuir uma role
    public function actions()
    {
        $actions = parent::actions();
        unset($actions['create']);
        return $actions;
    }

    public function actionCreate()
    {
        $userObj = json_decode(\Yii::$app->request->getRawBody());

        $user = new User();
        $user->email = $userObj->email;
        $user->name = $userObj->name;
        $user->number = $userObj->number;
        $user->setPassword($userObj->password);
        $user->generateAuthKey();
        $user->generateEmailVerificationToken();
        $user->isEmployee = 0;

        $save_result = $user->save();

        if ($save_result) {
            $auth = \Yii::$app->authManager;
            $authorRole = $auth->getRole('customer');
            $auth->assign($authorRole, $user->getId());
        }

        return $user;
    }

    public function actionLogin()
    {
        $response = (['id' => 0, 'success' => false]);

        if ($this->user != null) {

            $response["id"] = $this->user->id;
            $response["success"] = true;

            return $response;
        }

        return $response;
    }

}