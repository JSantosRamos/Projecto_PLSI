<?php

namespace frontend\controllers;

use common\models\Contactuser;
use common\models\ReserveSearch;
use common\models\TestdriveSearch;
use common\models\User;
use common\models\Vehicle;
use common\models\VendauserSearch;
use frontend\models\ResendVerificationEmailForm;
use frontend\models\VerifyEmailForm;
use Yii;
use yii\base\InvalidArgumentException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;

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
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout', 'areapessoal'],
                        'allow' => true,
                        'roles' => ['@'],
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
            'captcha' => [
                'class' => \yii\captcha\CaptchaAction::class,
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        $vehicles = Vehicle::find()->where(['isActive' => 1])->all();

        return $this->render('index', ['vehicles' => $vehicles]);
    }

    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';

        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return mixed
     */
    public function actionContact()
    {
        $model = new Contactuser();

        $email = '';
        $name = '';

        if (!Yii::$app->user->isGuest) {

            $user = Yii::$app->user->identity;

            $email = $user->email;
            $name  = $user->name;
        }

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {

                Yii::$app->session->setFlash('success', 'Obrigado pelo seu contacto, iremos responder o mais rápido possível para ' . $model->email);
                return $this->redirect('index');
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('contact', [
            'model' => $model,
            'email' => $email,
            'name' => $name,
        ]);
    }

    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup()
    {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post()) && $model->signup()) {
            Yii::$app->session->setFlash('success', 'Obrigado pelo seu registo, faça login para continuar.');
            return $this->goHome();
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    public function actionAreapessoal()
    {
        if (Yii::$app->user->isGuest) {
            return $this->actionLogin();
        }

        $searchModelVendauser = new VendauserSearch();
        $dataProviderVendauser = $searchModelVendauser->search($this->request->queryParams, false);

        $searchModelTestdrive = new TestdriveSearch();
        $dataProviderTestdrive = $searchModelTestdrive->search($this->request->queryParams, false);

        $searchModelReserve = new ReserveSearch();
        $dataProviderReserve = $searchModelReserve->search($this->request->queryParams, false);


        return $this->render('areapessoal', [
            'searchModelTestdrive' => $searchModelTestdrive,
            'dataProviderTestdrive' => $dataProviderTestdrive,
            'searchModelVendauser' => $searchModelVendauser,
            'dataProviderVendauser' => $dataProviderVendauser,
            'searchModelReserve' => $searchModelReserve,
            'dataProviderReserve' => $dataProviderReserve,
        ]);
    }
}
