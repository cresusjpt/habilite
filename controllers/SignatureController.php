<?php

namespace app\controllers;

use Yii;
use app\models\Signature;
use app\models\SignatureSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * SignatureController implements the CRUD actions for Signature model.
 */
class SignatureController extends HController
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Signature models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SignatureSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Lists all Mine Signature models.
     * @return mixed
     */
    public function actionMesSignature()
    {
        $searchModel = new SignatureSearch();
        $dataProvider = $searchModel->searchForMe(Yii::$app->request->queryParams);

        return $this->render('mine', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Signature model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Signature model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionMyCreate()
    {
        $model = new Signature();
        $model->IDENTIFIANT = Yii::$app->user->id;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            if ($model->ACTIF == true){
                $update = Signature::findAll(['IDENTIFIANT'=>$model->IDENTIFIANT]);
                foreach ($update as $value){
                    if ($value->ID_SIGNATURE != $model->ID_SIGNATURE){
                        $value->ACTIF = 0;
                        $value->save();
                    }
                }
            }
            return $this->redirect(['view', 'id' => $model->ID_SIGNATURE]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Creates a new Signature model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Signature();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            if ($model->ACTIF == true){
                $update = Signature::findAll(['IDENTIFIANT'=>$model->IDENTIFIANT]);
                foreach ($update as $value){
                    if ($value->ID_SIGNATURE != $model->ID_SIGNATURE){
                        $value->ACTIF = 0;
                        $value->save();
                    }
                }
            }
            return $this->redirect(['view', 'id' => $model->ID_SIGNATURE]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Signature model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            if ($model->ACTIF == true){
                $update = Signature::findAll(['IDENTIFIANT'=>$model->IDENTIFIANT]);
                foreach ($update as $value){
                    if ($value->ID_SIGNATURE != $model->ID_SIGNATURE){
                        $value->ACTIF = 0;
                        $value->save();
                    }
                }
            }
            return $this->redirect(['view', 'id' => $model->ID_SIGNATURE]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Signature model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Signature model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Signature the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Signature::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'La page que vous demandez n\'existe pas.'));
    }
}
