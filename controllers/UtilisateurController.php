<?php

namespace app\controllers;

use app\models\Profil;
use app\models\UserProfil;
use Yii;
use app\models\Utilisateur;
use app\models\UtilisateurSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * UtilisateurController implements the CRUD actions for Utilisateur model.
 */
class UtilisateurController extends HController
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
     * Lists all Utilisateur models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UtilisateurSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Utilisateur model.
     * @param string $id
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
     * Creates a new Utilisateur model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     * @throws Yii\base\Exception
     */
    public function actionCreate()
    {
        $model = new Utilisateur();

        if ($model->load(Yii::$app->request->post()) ) {

            $profil = Profil::findOne(['CODE_PROFIL'=>$model->profil]);
            $model->rawpassword = $model->PASSWORD;
            if ($model->verifyIsConform($model->PASSWORD)){
                $model->setPassword($model->PASSWORD);
            }else{
                Yii::$app->session->setFlash('danger','Le mot de passe ne répond pas aux exigences établies par votre administrateur.');
                $model->addError($model->PASSWORD, 'Le mot de passe ne répond pas aux exigences établies par votre administrateur.');
            }

            if ($model->save()){
                $user_profil = new UserProfil();
                $user_profil->CODE_PROFIL = $profil->CODE_PROFIL;
                $user_profil->IDENTIFIANT = $model->IDENTIFIANT;
                $user_profil->save();

                return $this->redirect(['view', 'id' => $model->IDENTIFIANT]);
            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Utilisateur model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     * @throws Yii\base\Exception
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {

            //TODO permit to edit user without changing his password
            $profil = Profil::findOne(['CODE_PROFIL'=>$model->profil]);

            $model->rawpassword = $model->PASSWORD;
            if ($model->verifyIsConform($model->PASSWORD)){
                $model->setPassword($model->PASSWORD);
            }else{
                Yii::$app->session->setFlash('danger','Le mot de passe ne répond pas aux exigences établies par votre administrateur.');
                $model->addError($model->PASSWORD, 'Le mot de passe ne répond pas aux exigences établies par votre administrateur.');
            }

            if ($model->save()){
                $user_profil = UserProfil::findOne(['IDENTIFIANT'=>$model->IDENTIFIANT]);
                $user_profil->CODE_PROFIL = $profil->CODE_PROFIL;
                $user_profil->save();

                return $this->redirect(['view', 'id' => $model->IDENTIFIANT]);
            }
        }

        Yii::$app->session->setFlash('info',"La modification d'un utilisateur se passe forcement par la modification de son mot de passe !");

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Utilisateur model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
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
     * Finds the Utilisateur model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Utilisateur the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Utilisateur::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
