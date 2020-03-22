<?php

namespace app\controllers;

use app\models\HabilitationV;
use app\models\ValiderV;
use app\models\ValiderModel;
use Exception;
use kartik\form\ActiveForm;
use Yii;
use app\models\Valider;
use app\models\ValiderSearch;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;

/**
 * ValiderController implements the CRUD actions for Valider model.
 */
class ValiderController extends HController
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
     * Lists all Valider models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ValiderSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Valider model.
     * @param integer $ID_SERVICE
     * @param integer $ID_HABILITE
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($ID_SERVICE, $ID_HABILITE)
    {
        return $this->render('view', [
            'models' => $this->findModels($ID_HABILITE),
        ]);
    }

    /**
     * Creates a new Valider model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new HabilitationV();
        $modelParam = [new ValiderV()];

        if ($model->load(Yii::$app->request->post())) {

            $modelParam = ValiderModel::createMultiple(ValiderV::class);
            ValiderModel::loadMultiple($modelParam, Yii::$app->request->post());

            //ajax validation
            if (Yii::$app->request->isAjax) {
                Yii::$app->response->format = Response::FORMAT_JSON;
                return ArrayHelper::merge(
                    ActiveForm::validateMultiple($modelParam),
                    ActiveForm::validateMultiple($model)
                );
            }

            //validate all models
            $valid = $model->validate();
            $valid = ValiderModel::validateMultiple($modelParam) && $model;

            if ($valid) {
                $transaction = Yii::$app->db->beginTransaction();
                try {
                    if ($flag = true) {
                        foreach ($modelParam as $oneParam) {
                            $oneParam->ID_HABILITE = $model->ID_HABILITE;

                            if (!($flag = $oneParam->save(false))) {
                                $transaction->rollBack();
                                break;
                            }
                        }
                    }

                    if ($flag) {
                        $transaction->commit();
                        return $this->redirect(['view', 'ID_SERVICE' => $modelParam[0]->ID_SERVICE, 'ID_HABILITE' => $modelParam[0]->ID_HABILITE]);
                    }

                } catch (\Exception $exception) {
                    $transaction->rollBack();
                    var_dump($exception->getMessage());
                    die();
                }
            }
        }

        return $this->render('create', [
            'model' => $model,
            'modelParam' => (empty($modelParam)) ? [new ValiderV] : $modelParam
        ]);
    }

    /**
     * Updates an existing Valider model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $ID_SERVICE
     * @param integer $ID_HABILITE
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($ID_SERVICE = "", $ID_HABILITE)
    {
        $model = HabilitationV::findOne(['ID_HABILITE' => $ID_HABILITE]);
        $modelParam = $model->validers;

        if ($model->load(Yii::$app->request->post())) {

            $oldIDs = ArrayHelper::map($modelParam, 'ID_HABILITE', 'ID_HABILITE');
            $modelParam = ValiderModel::createMultiple(ValiderV::class, $modelParam);
            ValiderModel::loadMultiple($modelParam, Yii::$app->request->post());
            $deletedIDs = array_diff($oldIDs, array_filter(ArrayHelper::map($modelParam, 'ID_HABILITE', 'ID_HABILITE')));

            // ajax validation
            if (Yii::$app->request->isAjax) {
                Yii::$app->response->format = Response::FORMAT_JSON;
                return ArrayHelper::merge(
                    ActiveForm::validateMultiple($model),
                    ActiveForm::validate($modelParam)
                );
            }

            // validate all models
            $valid = $model->validate();
            $valid = ValiderModel::validateMultiple($modelParam) && $valid;

            if ($valid) {
                $transaction = \Yii::$app->db->beginTransaction();
                try {
                    if ($flag = true) {
                        if (!empty($deletedIDs)) {
                            ValiderV::deleteAll(['ID_HABILITE' => $deletedIDs]);
                        }
                        foreach ($modelParam as $oneParam) {
                            $oneParam->ID_HABILITE = $model->ID_HABILITE;
                            if (!($flag = $oneParam->save(false))) {
                                $transaction->rollBack();
                                break;
                            }
                        }
                    }
                    if ($flag) {
                        $transaction->commit();
                        return $this->redirect(['view', 'ID_SERVICE' => $modelParam[0]->ID_SERVICE, 'ID_HABILITE' => $model->ID_HABILITE]);
                    }
                } catch (Exception $e) {
                    $transaction->rollBack();
                }
            }
        }

        return $this->render('update', [
            'model' => $model,
            'modelParam' => (empty($modelParam)) ? [new ValiderV] : $modelParam,
        ]);
    }

    /**
     * Deletes an existing Valider model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $ID_SERVICE
     * @param integer $ID_HABILITE
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function actionDelete($ID_SERVICE, $ID_HABILITE)
    {
        $this->findModel($ID_SERVICE, $ID_HABILITE)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Valider model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $ID_SERVICE
     * @param integer $ID_HABILITE
     * @return Valider the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected
    function findModel($ID_SERVICE, $ID_HABILITE)
    {
        if (($model = Valider::findOne(['ID_SERVICE' => $ID_SERVICE, 'ID_HABILITE' => $ID_HABILITE])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }

    /**
     * Finds the Valider models based on its primary key value.
     * If the models is not found, a 404 HTTP exception will be thrown.
     * @param integer $ID_HABILITE
     * @return Valider[]
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected
    function findModels($ID_HABILITE)
    {
        if (($model = Valider::findAll(['ID_HABILITE' => $ID_HABILITE])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', "La page que vous demandez n'existe pas."));
    }
}
