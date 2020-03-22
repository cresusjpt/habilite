<?php

namespace app\controllers;

use Yii;
use app\models\UserProfil;
use app\models\UserProfilSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * UserProfilController implements the CRUD actions for UserProfil model.
 */
class UserProfilController extends HController
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
     * Lists all UserProfil models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UserProfilSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single UserProfil model.
     * @param string $IDENTIFIANT
     * @param string $CODE_PROFIL
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($IDENTIFIANT, $CODE_PROFIL)
    {
        return $this->render('view', [
            'model' => $this->findModel($IDENTIFIANT, $CODE_PROFIL),
        ]);
    }

    /**
     * Creates a new UserProfil model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new UserProfil();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'IDENTIFIANT' => $model->IDENTIFIANT, 'CODE_PROFIL' => $model->CODE_PROFIL]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing UserProfil model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $IDENTIFIANT
     * @param string $CODE_PROFIL
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($IDENTIFIANT, $CODE_PROFIL)
    {
        $model = $this->findModel($IDENTIFIANT, $CODE_PROFIL);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'IDENTIFIANT' => $model->IDENTIFIANT, 'CODE_PROFIL' => $model->CODE_PROFIL]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing UserProfil model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $IDENTIFIANT
     * @param string $CODE_PROFIL
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($IDENTIFIANT, $CODE_PROFIL)
    {
        $this->findModel($IDENTIFIANT, $CODE_PROFIL)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the UserProfil model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $IDENTIFIANT
     * @param string $CODE_PROFIL
     * @return UserProfil the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($IDENTIFIANT, $CODE_PROFIL)
    {
        if (($model = UserProfil::findOne(['IDENTIFIANT' => $IDENTIFIANT, 'CODE_PROFIL' => $CODE_PROFIL])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
