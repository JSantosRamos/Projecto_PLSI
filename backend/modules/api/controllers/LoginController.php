<?php

namespace backend\modules\api\controllers;

use APIResponse;
use common\models\LoginForm;
use common\models\User;
use yii\db\ActiveRecord;
use yii\filters\auth\HttpBasicAuth;
use yii\web\Controller;
use yii\web\ForbiddenHttpException;

/**
 * Default controller for the `api` module
 */
class LoginController extends Controller
{
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

    /**
     * @throws ForbiddenHttpException
     */
    public function auth($email, $password): User
    {
        $user = User::findByEmail($email);
        if ($user && $user->validatePassword($password)) {

            $this->user = $user;
            return $user;
        }

        throw new \yii\web\ForbiddenHttpException('No authentication');
    }

    public function actionLogin()
    {
        $response = null;

        if ($this->user != null) {

            $response = (['id' => $this->user->id, 'success' => true]);

        } else {

            $response = (['id' => 0, 'success' => false]);
        }

        return $this->asJson($response);
    }

    public function actionSignup()
    {
        $obj = \Yii::$app->request->rawBody;

        $userObj = json_decode($obj);

        $user = new User();
        $user->email = $userObj->email;
        $user->name = $userObj->name;
        $user->number = $userObj->number;
        $user->setPassword($userObj->password);
        $user->generateAuthKey();
        $user->generateEmailVerificationToken();
        $w = $user->validate();

        echo '<pre>';
        var_dump($w);
        echo '</pre>';
        exit;

        //$user->save();

        /* $auth = \Yii::$app->authManager;
         $authorRole = $auth->getRole('customer');
         $auth->assign($authorRole, $user->getId());
 */
        return $user;
    }
}
