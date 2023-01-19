<?php

namespace backend\modules\api\controllers;

use APIResponse;
use backend\modules\api\model\Vendedor;
use common\models\LoginForm;
use common\models\User;
use Yii;
use yii\filters\auth\HttpBasicAuth;
use yii\rest\ActiveController;
use yii\web\ForbiddenHttpException;
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
            'except' => ['create'],
            'auth' => [$this, 'auth'],
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

        throw new ForbiddenHttpException('No authentication');
    }

    public function checkAccess($action, $model = null, $params = [])
    {
        if ($action === 'index' or $action === 'delete') {
            throw new ForbiddenHttpException('Proibido');
        }

        $params = Yii::$app->request->queryParams;
        $id = $params["id"];

        if (($action === 'update' or $action === 'view') && ($this->user->id != $id)) {
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
        $userObj = json_decode(\Yii::$app->request->getRawBody());

        if (User::findByEmail($userObj->email) != null) {

            return ["sucesso" => false, "message" => 'Email já registado.']; //verifica se o email não existe
        }

        $user = new User();
        $user->email = $userObj->email;
        $user->name = $userObj->name;
        $user->setPassword($userObj->password);
        $user->generateAuthKey();
        $user->generateEmailVerificationToken();
        $user->isEmployee = 0;

        $result = $user->save();

        if ($result) {
            $auth = \Yii::$app->authManager;
            $authorRole = $auth->getRole('customer');
            $auth->assign($authorRole, $user->getId());

            return ["sucesso" => $result, "message" => ''];
        }

        return $user;
    }

    public function actionLogin()
    {
        return (['id' => $this->user->id, 'name' => $this->user->name, 'email' => $this->user->email, 'success' => true]);
    }

    public function actionVendedores()
    {
        $user = new $this->modelClass;

        $users = $user::find()->where(['isEmployee' => 1])->all();

        if ($users != null) {

            $vendedores = [];
            foreach ($users as $user) {
                $vendedor = new Vendedor($user->email, $user->name);
                $vendedores[] = $vendedor;
            }
            return ['Vendedores' => $vendedores];
        }

        return $user;
    }

    public function actionTotal()
    {
        $user = new $this->modelClass;
        $total = $user::find()->count();
        return ['total' => $total];
    }
}