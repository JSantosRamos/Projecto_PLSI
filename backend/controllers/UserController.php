<?php

namespace backend\controllers;

use backend\models\AuthAssignment;
use backend\models\AuthAssignmentSearch;
use common\models\Role;
use common\models\User;
use common\models\UserSearch;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\db\StaleObjectException;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use yii\validators\BooleanValidator;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use function PHPUnit\Framework\throwException;

/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'access' => [
                    'class' => AccessControl::class,
                    'rules' => [
                        [
                            'actions' => ['index', 'view'],
                            'allow' => true,
                            'roles' => ['employee'],
                        ],
                        [
                            'actions' => ['create', 'update'],
                            'allow' => true,
                            'roles' => ['manager'],
                        ],
                        [
                            'actions' => ['delete'],
                            'allow' => true,
                            'roles' => ['admin'],
                        ],
                    ],
                ],
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all User models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $sessionUserId = Yii::$app->user->getId();

        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);


        //Users Assignement
        $userPermissons = null; //searchModel para AuthAssigment
        $userPermissonsSearch = null; //dataProvider para AuthAssigment

        if (Yii::$app->authManager->checkAccess($sessionUserId, 'canCreateAllUsers') || Yii::$app->authManager->checkAccess($sessionUserId, 'canCreateEmployee')) {

            $userPermissonsSearch = new AuthAssignmentSearch();
            $userPermissons = $userPermissonsSearch->search($this->request->queryParams); //retorna dados do tipo dataProvider para AuthAssigment
        }

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'userPermissons' => $userPermissons,
            'userPermissonsSearch' => $userPermissonsSearch,
        ]);
    }

    /**
     * Displays a single User model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new User();
        $normalPassword = '';

        if ($this->request->isPost) {

            if ($model->load($this->request->post())) {

                if (!empty($model->password_hash)) {
                    $normalPassword = $model->password_hash; //guarda a password antes de criar a hash para enviar para o user

                    $model->generateAuthKey();
                    $model->generateEmailVerificationToken();
                    $model->setPassword($model->password_hash);
                }

                if ($model->save()) {

                    if ($model->isEmployee == 1) //checkbox is selected
                    {
                        $roleName = 'employee';

                    } else {
                        $roleName = 'customer';
                    }

                    if (!$this->setUserAuth($roleName, $model->getId())) {

                        Yii::$app->session->setFlash('error', 'Erro nas permissões do utilizador!');
                        return $this->redirect(['user/index']);
                    }

                    $this->sendpassword($model->email, $normalPassword); //envia para o user

                    return $this->redirect(['view', 'id' => $model->id]);
                }
            }

        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', ['model' => $model,]);
    }

    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public
    function actionUpdate($id)
    {
        $updateValido = true;
        $sessionUserID = Yii::$app->user->getId();

        $sessionUserRole = User::getRoleName($sessionUserID);
        $updateUserRole = User::getRoleName($id);

        if ($sessionUserID != $id) {

            switch ($sessionUserRole) {
                case 'admin':
                    break;
                case 'manager':
                    if ($updateUserRole == 'admin' || $updateUserRole == 'manager') {
                        $updateValido = false;
                    }
                    break;
                case 'employee':
                    if ($updateUserRole == 'admin' || $updateUserRole == 'manager' || $updateUserRole == 'employee') {
                        $updateValido = false;
                    }
                    break;
            }
        }

        if (!$updateValido) {

            return $this->redirect(['index']);
        }

        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post())) {

            if ($model->save()) {

                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing User model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public
    function actionDelete($id)
    {
        $model = $this->findModel($id);

        try {
            if ($model->delete()) {

                //delete permissoes
                $permission = AuthAssignment::findOne(['user_id' => $id]);
                if ($permission != null) {
                    $permission->delete();
                }
            }

        } catch (\Throwable $e) {

            return $this->redirect(['view', 'id' => $model->id, 'erro_delete' => 'true']);//users com reservas  ou vendas
        }

        return $this->redirect(['index']);
    }


    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected
    function findModel($id)
    {
        if (($model = User::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    private function sendpassword($email, $password)
    {
        Yii::$app->mailer->compose()
            ->setFrom('standauto@domain.com')
            ->setTo($email)
            ->setSubject('Email sent from Yii2-Swiftmailer')
            ->setTextBody('Password: ' . $password)
            ->send();
    }

    private function setUserAuth($roleName, $user_id): bool
    {
        $auth = \Yii::$app->authManager;

        $authorRole = $auth->getRole($roleName);

        try {
            $auth->assign($authorRole, $user_id);
        } catch (\Exception $e) {

            return false;
        }

        return true;
    }
}
