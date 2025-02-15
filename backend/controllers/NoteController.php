<?php

namespace backend\controllers;

use common\models\Note;
use common\models\NoteSearch;
use common\models\User;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\ForbiddenHttpException;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;
use function PHPUnit\Framework\isNull;

/**
 * NoteController implements the CRUD actions for Note model.
 */
class NoteController extends Controller
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
                            'actions' => ['index', 'view', 'update', 'create', 'delete'],
                            'allow' => true,
                            'roles' => ['employee'],
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
     * Creates a new Note model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|Response
     */
    public function actionCreate()
    {
        $model = new Note();
        $model->idUser = Yii::$app->user->getId();

        if (isset($_GET['idVenda'])) {
            $model->idproposta_venda = $_GET['idVenda'];
        }

        if (isset($_GET['idTask'])) {
            $model->idTask = $_GET['idTask'];
        }

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                if ($model->idTask != null) {
                    return $this->redirect(['/task/view', 'id' => $model->idTask]);
                } else {
                    return $this->redirect(['/vendauser/view', 'id' => $model->idproposta_venda]);
                }
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Note model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|Response
     * @throws NotFoundHttpException if the model cannot be found
     * @throws ForbiddenHttpException
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $userID = Yii::$app->user->id;

        $role = User::getRoleName($userID);

        if ($role != 'admin') {

            if ($role == 'employee' && $model->idUser != $userID) //se o user tem role employee só pode alterar as suas notas
            {
                return $this->redirect(['/site/index']);
            }

            if (($role == 'manager' && User::isManager($model->idUser)) && $userID != $model->id) //se o user tem role de manager pode alterar notas de roles abaixo de si mas não ao mesmo nível
            {
                throw new ForbiddenHttpException('Não pode alterar notas de outro manager');
            }

            if ($role == 'manager' && User::isAdmin($model->idUser)) //não pode alterar notas de roles acima de si
            {
                throw new ForbiddenHttpException('Não pode alterar notas de um admin');
            }
        }

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            if ($model->idTask != null) { //As notas podem ser atribuidas a tarefas ou propostas depois da alteração verifica para onde enviar o utilizador.
                return $this->redirect(['/task/view', 'id' => $model->idTask]);
            } else {
                return $this->redirect(['/vendauser/view', 'id' => $model->idproposta_venda]);
            }
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Note model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $returnID = null;
        $type = null;

        $model = $this->findModel($id);

        $userID = Yii::$app->user->id;

        $role = User::getRoleName($userID);

        if ($role != 'admin') {

            if ($role == 'employee' && $model->idUser != $userID) //se o user tem role employee só pode alterar as suas notas
            {
                return $this->redirect(['/site/index']);
            }

            if (($role == 'manager' && User::isManager($model->idUser)) && $userID != $model->id) //se o user tem role de manager pode alterar notas de roles abaixo de si mas não ao mesmo nível
            {
                throw new ForbiddenHttpException('Não pode alterar notas de outro manager');
            }

            if ($role == 'manager' && User::isAdmin($model->idUser)) //não pode alterar notas de roles acima de si
            {
                throw new ForbiddenHttpException('Não pode alterar notas de um admin');
            }
        }

        if ($model->idTask != null) {
            $returnID = $model->idTask;
            $type = 'task';

        } else {
            $returnID = $model->idproposta_venda;
            $type = 'venda';
        }

        $model->delete();

        if ($type == 'task') {
            return $this->redirect(['/task/view', 'id' => $returnID]);
        } else {
            return $this->redirect(['/vendauser/view', 'id' => $returnID]);
        }
    }

    /**
     * Finds the Note model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Note the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Note::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
