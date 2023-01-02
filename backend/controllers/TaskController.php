<?php

namespace backend\controllers;

use backend\models\AuthAssignment;
use common\models\Note;
use common\models\NoteSearch;
use common\models\Task;
use common\models\TaskSearch;
use common\models\User;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * TaskController implements the CRUD actions for Task model.
 */
class TaskController extends Controller
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
                            'actions' => ['index', 'view', 'update'],
                            'allow' => true,
                            'roles' => ['employee'],
                        ],
                        [
                            'actions' => ['create', 'delete'],
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
     * Lists all Task models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new TaskSearch();
        $dataProvider = $searchModel->search($this->request->queryParams); //No TaskSearch verifica a role se for employee só devolve as tarefas atribuidas a esse id.

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Task model.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {

        $model = $this->findModel($id);
        $userID = \Yii::$app->user->id;

        if (User::isEmployee($userID) && $model->idAssigned_to != $userID) {
            return $this->redirect('/task/index');
        }

        $searchModelNote = new NoteSearch();
        $searchModelNote->idTask = $id;
        $notes = $searchModelNote->search($this->request->queryParams);

        return $this->render('view', [
            'model' => $model,
            'notes' => $notes
        ]);
    }

    /**
     * Creates a new Task model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Task();
        $model->idCreated_by = \Yii::$app->user->id;
        $employees = ArrayHelper::map(User::find()->where(['isEmployee' => 1])->all(), 'id', 'name');
        $message = '';

        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {

                if (!$this->validateDate($model->date)) {
                    $message = 'Data inválida';
                } else {
                    $model->save();
                    return $this->redirect(['view', 'id' => $model->id]);
                }
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
            'employees' => $employees,
            'message' => $message,

        ]);
    }

    /**
     * Updates an existing Task model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $userID = \Yii::$app->user->id;

        if (User::isEmployee($userID) && $model->idAssigned_to != $userID) {
            return $this->redirect('/task/index');
        }

        $employees = ArrayHelper::map(User::find()->where(['isEmployee' => 1])->all(), 'id', 'name');

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
            'employees' => $employees,
            'message' => '',
        ]);
    }

    /**
     * Deletes an existing Task model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $notes = Note::find()->select('id')->where(['idTask' => $id])->all();

        $this->safeDelete($notes);

        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Task model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Task the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Task::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    /**
     * Deletes all Notes from the Task to safe delete the Task
     * @param array $items All Notes ids from Task
     */
    private function safeDelete($items)
    {

        if (empty($items)) {
            return;
        }

        foreach ($items as $item) {
            $note = Note::findOne($item->id);

            if (!empty($note)) {
                $note->delete();
            }
        }
    }

    private function getEmployees()
    {
        $data = [];

        $employees = User::find()->select('id, name',)->where(['isEmployee' => 1])->all();

        foreach ($employees as $employee) {
            $result = AuthAssignment::find()->select('item_name')->where(['user_id' => $employee->id])->one();

            if ('employee' == $result->item_name) {

                $data[] = $employee->name;
            }
        }

        return $data;
    }

    private function validateDate($date)
    {
        $todayDate = gmdate('d-m-Y H:i');

        $date = strtotime($date);
        $todayDate = strtotime($todayDate);

        return $date > $todayDate;
    }
}
