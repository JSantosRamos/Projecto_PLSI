<?php

namespace backend\controllers;

use common\models\LoginForm;
use Yii;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yiiunit\extensions\bootstrap5\data\User;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['index' , 'logout'],
                        'allow' => true,
                        'roles' => ['employee'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => \yii\web\ErrorAction::class,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return string|Response
     */
    public function actionLogin()
    {
        $userId = Yii::$app->user->getId();
        $message = null;

        if ($userId != null && Yii::$app->authManager->checkAccess($userId, 'canAccessBackOffice')) {
            return $this->goHome();
        }

        $model = new LoginForm();

        if ($userId != null && !Yii::$app->authManager->checkAccess($userId, 'canAccessBackOffice')) {
            Yii::$app->user->logout();
            return $this->render('login', ['model' => $model]);
        }

        $this->layout = 'blank';

        if ($model->load(Yii::$app->request->post()) && $model->login()) {

            $userId = Yii::$app->user->getId();

            if (Yii::$app->authManager->checkAccess($userId, 'canAccessBackOffice')) {
                return $this->goHome();
            } else {
                Yii::$app->user->logout();
                $message = 'Não tem permissões para aceder a esta área!';
                return $this->render('login', ['model' => $model, 'message' => $message]);
            }
        }

        $model->password = '';

        return $this->render('login', [
            'model' => $model, 'message' => $message
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
}
