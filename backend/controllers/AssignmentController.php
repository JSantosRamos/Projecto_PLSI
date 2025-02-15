<?php

namespace backend\controllers;

use backend\models\AuthAssignment;
use backend\models\AuthAssignmentSearch;
use backend\models\AuthItem;
use common\models\User;
use Yii;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * AuthAssignmentController implements the CRUD actions for AuthAssignment model.
 */
class AssignmentController extends Controller
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
                            'actions' => ['index', 'update', 'view'],
                            'allow' => true,
                            'roles' => ['manager'],
                        ],
                        [
                            'actions' => ['create','delete'],
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
     * Lists all AuthAssignment models.
     *
     * @return \yii\web\Response
     */
    public function actionIndex()
    {
        return $this->redirect('/user/index');
        /*$searchModel = new AuthAssignmentSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);*/
    }

    /**
     * Displays a single AuthAssignment model.
     * @param string $item_name Item Name
     * @param string $user_id User ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($item_name, $user_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($item_name, $user_id),
        ]);
    }

    /**
     * Creates a new AuthAssignment model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $roles = [];
        $model = new AuthAssignment();

        $sessionUserId = Yii::$app->user->getId();

        if (Yii::$app->authManager->checkAccess($sessionUserId, 'canCreateAllUsers')) {
            $roles = ArrayHelper::map(AuthItem::find()
                ->where(['type' => 1])
                ->all(), 'name', 'name');
        }

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'item_name' => $model->item_name, 'user_id' => $model->user_id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
            'roles' => $roles
        ]);
    }

    /**
     * Updates an existing AuthAssignment model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $item_name Item Name
     * @param string $user_id User ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($item_name, $user_id)
    {
        $sessionUserId = Yii::$app->user->getId();

        if(!User::isAdmin($sessionUserId)){

            if(User::isAdmin($user_id)){ //manager não pode alterar um admin
                throw new \yii\web\ForbiddenHttpException('Não pode alterar um admin');
            }

            if(User::isManager($user_id)){ //manager não pode alterar outro managerc incluindo ele proprio
                throw new \yii\web\ForbiddenHttpException('Não pode alterar um manager');
            }
        }

        $roles = [];
        $model = $this->findModel($item_name, $user_id);

        if (Yii::$app->authManager->checkAccess($sessionUserId, 'canCreateAllUsers')) {
            $roles = ArrayHelper::map(AuthItem::find()
                ->where(['type' => 1])
                ->all(), 'name', 'name');

        } elseif (Yii::$app->authManager->checkAccess($sessionUserId, 'canCreateEmployee')) {
            $roles = ArrayHelper::map(AuthItem::find()
                ->where(['type' => 1])
                ->all(), 'name', 'name');

            if (($key = array_search("admin", $roles)) !== false) {
                unset($roles[$key]);
            }
            if (($key2 = array_search("manager", $roles)) !== false) {
                unset($roles[$key2]);
            }
        }

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'item_name' => $model->item_name, 'user_id' => $model->user_id]);
        }

        return $this->render('update', [
            'model' => $model,
            'roles' => $roles,
        ]);
    }

    /**
     * Deletes an existing AuthAssignment model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $item_name Item Name
     * @param string $user_id User ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($item_name, $user_id)
    {
        $this->findModel($item_name, $user_id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the AuthAssignment model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $item_name Item Name
     * @param string $user_id User ID
     * @return AuthAssignment the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($item_name, $user_id)
    {
        if (($model = AuthAssignment::findOne(['item_name' => $item_name, 'user_id' => $user_id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
