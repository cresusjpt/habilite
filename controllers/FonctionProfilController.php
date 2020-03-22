<?php

namespace app\controllers;

use Yii;
use app\models\FonctionProfil;
use app\models\FonctionProfilSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * FonctionProfilController implements the CRUD actions for FonctionProfil model.
 */
class FonctionProfilController extends HController
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
     * Lists all FonctionProfil models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new FonctionProfilSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single FonctionProfil model.
     * @param string $ID_FONCT
     * @param string $CODE_PROFIL
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($ID_FONCT, $CODE_PROFIL)
    {
        return $this->render('view', [
            'model' => $this->findModel($ID_FONCT, $CODE_PROFIL),
        ]);
    }

    /**
     * Creates a new FonctionProfil model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new FonctionProfil();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'ID_FONCT' => $model->ID_FONCT, 'CODE_PROFIL' => $model->CODE_PROFIL]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing FonctionProfil model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $ID_FONCT
     * @param string $CODE_PROFIL
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($ID_FONCT, $CODE_PROFIL)
    {
        $model = $this->findModel($ID_FONCT, $CODE_PROFIL);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'ID_FONCT' => $model->ID_FONCT, 'CODE_PROFIL' => $model->CODE_PROFIL]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing FonctionProfil model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $ID_FONCT
     * @param string $CODE_PROFIL
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($ID_FONCT, $CODE_PROFIL)
    {
        $this->findModel($ID_FONCT, $CODE_PROFIL)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the FonctionProfil model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $ID_FONCT
     * @param string $CODE_PROFIL
     * @return FonctionProfil the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($ID_FONCT, $CODE_PROFIL)
    {
        if (($model = FonctionProfil::findOne(['ID_FONCT' => $ID_FONCT, 'CODE_PROFIL' => $CODE_PROFIL])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
