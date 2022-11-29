<?php

namespace backend\controllers;

use backend\models\AuthAssignment;
use backend\models\AuthAssignmentSearch;
use common\models\Role;
use common\models\User;
use common\models\UserSearch;
use Yii;
use yii\base\Model;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

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
                            'actions' => ['index', 'view', 'create', 'update'],
                            'allow' => true,
                            'roles' => ['employee'],
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
        $searchModelAssignment = null;
        $dataProviderAssignment = null;

        $sessionUserId = Yii::$app->user->getId();
        if (Yii::$app->authManager->checkAccess($sessionUserId, 'canCreateAllUsers') || Yii::$app->authManager->checkAccess($sessionUserId, 'canCreateEmployee')) {

            $searchModelAssignment = new AuthAssignmentSearch();
            $dataProviderAssignment = $searchModelAssignment->search($this->request->queryParams);
        }

        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'searchModelAssignment' => $searchModelAssignment,
            'dataProviderAssignment' => $dataProviderAssignment
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
        //$sessionUserId = Yii::$app->user->getId();

        //if (Yii::$app->authManager->checkAccess($sessionUserId, 'canCreateAllUsers')) {

        // $roles = ArrayHelper::map(Role::find()->all(), 'id', 'name');
        //}

        if ($this->request->isPost) {

            if ($model->load($this->request->post())) {

                if (!empty($model->password_hash)) {
                    $model->generateAuthKey();
                    $model->generateEmailVerificationToken();
                    $model->setPassword($model->password_hash);
                }

                if ($model->save()) {
                    $auth = \Yii::$app->authManager;
                    $authorRole = $auth->getRole('customer');
                    $auth->assign($authorRole, $model->getId());

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

        if ($sessionUserID != $id) {
            $role = User::isAdmin($sessionUserID) ? 'admin' : (User::isManager($sessionUserID) ? 'manager' : 'employee');
            $roleUserUpdate = User::isAdmin($id) ? 'admin' : (User::isManager($id) ? 'manager' : 'employee');

            switch ($role) {
                case 'admin':
                    break;
                case 'manager':
                    if ($roleUserUpdate == 'admin' || $roleUserUpdate == 'manager') {
                        $updateValido = false;
                    }
                    break;
                case 'employee':
                    if ($roleUserUpdate == 'admin' || $roleUserUpdate == 'manager' || $roleUserUpdate == 'employee') {
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

            $model->setPassword($model->password_hash);

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
        $this->findModel($id)->delete();

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

}
