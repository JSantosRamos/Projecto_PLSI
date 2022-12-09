<?php

namespace backend\controllers;

use common\models\Cost;
use common\models\LoginForm;
use common\models\Task;
use common\models\Testdrive;
use common\models\Vehicle;
use common\models\Venda;
use common\models\Vendauser;
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
                        'actions' => ['index', 'logout'],
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

        //Users
        $users = \common\models\User::getTotalUsers();
        $usersAtivos = \common\models\User::getTotalUsers();

        //Veiculos
        $veiculos = Vehicle::getTotal();
        $veiculosArray = Vehicle::getTotalStatus();

        //Despesas
        $despesas = Cost::getValorDespesas();

        //Tarefas
        $tarefas = Task::getTotalTarefas();
        $tarefasStatus = Task::getTotalStatus();

        //Vendas
        $vendas = Venda::getValorVendas();

        //Propostas de compra
        $propostas = Vendauser::getTotal();
        $propostasArray = Vendauser::getTotalStatus();
        $comprasTotal = Vendauser::getValorTotal();

        //TestDrive
        $drives = Testdrive::getTotal();

        $testDrive_PorVer = 0;
        $testDrive_Aceite = 0;
        $testDrive_Recusado = 0;
        $testDrive_AguardarResposta = 0;


        //Test-Drive
        $testDrives = Testdrive::find()->all();

        foreach ($testDrives as $testDrive) {

            switch ($testDrive->status) {
                case Testdrive::POR_VER:
                    ++$testDrive_PorVer;
                    break;
                case Testdrive::RECUSADO:
                    ++$testDrive_Recusado;
                    break;
                case Testdrive::ACEITE:
                    ++$testDrive_Aceite;
                    break;
                case Testdrive::AGUARDANDO_RESPOSTA:
                    ++$testDrive_AguardarResposta;
                    break;
            }
        }

        $driveArray = array("aceite" => $testDrive_Aceite, "recusado" => $testDrive_Recusado,
            "aguardar_resposta" => $testDrive_AguardarResposta, "por_ver" => $testDrive_PorVer);

        return $this->render('index', [
            'vendas' => $vendas,
            'despesas' => $despesas,
            'tarefas' => $tarefas,
            'users' => $users,
            'usersAtivos' => $usersAtivos,
            'driveArray' => $driveArray,
            'propostas' => $propostas,
            'drives' => $drives,
            'veiculos' => $veiculos,
            'tarefasStatus' => $tarefasStatus,
            'propostasArray' => $propostasArray,
            'veiculosArray' => $veiculosArray,
            'comprasTotal' => $comprasTotal
        ]);
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
