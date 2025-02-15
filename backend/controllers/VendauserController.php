<?php

namespace backend\controllers;

use common\models\Brand;
use common\models\Note;
use common\models\NoteSearch;
use common\models\Vendauser;
use common\models\VendauserSearch;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;

/**
 * VendauserController implements the CRUD actions for Vendauser model.
 */
class VendauserController extends Controller
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
                            'actions' => ['index', 'update', 'view', 'delete'],
                            'allow' => true,
                            'roles' => ['manager'],
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
     * Lists all Vendauser models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $brands = Brand::find()->all();
        $searchModel = new VendauserSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'brands' => $brands,
        ]);
    }

    /**
     * Displays a single Vendauser model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $searchModelNote = new NoteSearch();
        $searchModelNote->idproposta_venda = $id;
        $dataProviderNote = $searchModelNote->search($this->request->queryParams);

        return $this->render('view', [
            'model' => $this->findModel($id),
            'dataProviderNote' => $dataProviderNote,
        ]);
    }


    /**
     * Updates an existing Vendauser model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Vendauser model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $notes = Note::find()->select('id')->where(['idproposta_venda' => $id])->all();
        $this->safeDelete($notes);


        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Vendauser model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Vendauser the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Vendauser::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

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
}
