<?php

namespace app\controllers;

use app\models\EtatDemande;
use app\models\Habilitation;
use app\models\Niveau;
use app\models\Service;
use app\models\SysParam;
use app\models\Valider;
use Yii;
use app\models\Demande;
use app\models\DemandeSearch;
use yii\base\Exception;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;

/**
 * DemandeController implements the CRUD actions for Demande model.
 */
class DemandeController extends HController
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
     * Lists all Demande models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new DemandeSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Demande model.
     * @param string $IDENTIFIANT
     * @param integer $ID_HABILITE
     * @param integer $ID_DEMANDE
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($IDENTIFIANT, $ID_HABILITE, $ID_DEMANDE)
    {
        $model = $this->findModel($IDENTIFIANT, $ID_HABILITE, $ID_DEMANDE);
        $niveaus = Niveau::findAll(['ID_DEMANDE' => $model->ID_DEMANDE]);

        return $this->render('view', [
            'model' => $model,
            'niveaus' => $niveaus,
        ]);
    }

    /*
    I: send the file inline to the browser (default). The plug-in is used if available. The name given by name is used when one selects the “Save as” option on the link generating the PDF.
    D: send to the browser and force a file download with the name given by name.
    F: save to a local server file with the name given by name.
    S: return the document as a string. name is ignored.
    FI: equivalent to F + I option
    FD: equivalent to F + D option
    */
    /**
     * @param Demande $model
     * @return string
     * @throws Exception
     */
    private function demandeFileHelper(Demande $model)
    {

        $directory = Utils::getDemandeDir();

        $time = time() + 1;
        $fileName = str_replace(' ', '_', $model->eNTIFIANT->NOM/*$model->hABILITE->NOM_HABILITE.$model->DATE_DEMANDE*/) . $time . '.pdf';
        $filePath = $directory . $fileName;

        $pdf = new PDFUtils();
        $pdf = PDFUtils::preparePdf($pdf);
        $pdf->writeHTML($model->CONTENU_DEMANDE);

        $pdf->Output($filePath, 'F');
        return $fileName;
    }

    /**
     * Creates a new Demande model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     * @throws \yii\base\Exception
     */
    public function actionMyCreate()
    {
        $model = new Demande();
        $model->IDENTIFIANT = Yii::$app->user->id;

        if ($model->load(Yii::$app->request->post())) {
            $model->ETAT_DEMANDE = "CREE";
            $model->DATE_DEMANDE = date('Y-m-d H:i:s');

            $filePath = $this->demandeFileHelper($model);

            $model->SOURCE_DEMANDE = $filePath;
            if ($model->save()) {
                $this->createNiveau($model);
                return $this->redirect(['view', 'IDENTIFIANT' => $model->IDENTIFIANT, 'ID_HABILITE' => $model->ID_HABILITE, 'ID_DEMANDE' => $model->ID_DEMANDE]);
            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Creates a new Demande model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     * @throws \yii\base\Exception
     */
    public function actionCreate()
    {
        $model = new Demande();

        if ($model->load(Yii::$app->request->post())) {
            $model->ETAT_DEMANDE = "CREE";
            $model->DATE_DEMANDE = date('Y-m-d H:i:s');

            $filePath = $this->demandeFileHelper($model);

            $model->SOURCE_DEMANDE = $filePath;
            if ($model->save()) {
                $this->createNiveau($model);
                return $this->redirect(['view', 'IDENTIFIANT' => $model->IDENTIFIANT, 'ID_HABILITE' => $model->ID_HABILITE, 'ID_DEMANDE' => $model->ID_DEMANDE]);
            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * @param Demande $demande
     * @throws NotFoundHttpException
     */
    private function createNiveau(Demande $demande)
    {
        $validers = Valider::find()
            ->where(['ID_HABILITE' => $demande->ID_HABILITE])
            ->orderBy('NUM_ORDRE')
            ->all();

        $nom = $demande->hABILITE->NOM_HABILITE;

        if (count($validers) <= 0) {
            throw new NotFoundHttpException("Aucun validateur sur l'habilitation $nom. Veullez contacter l'administrateur");
        }

        $transaction = Yii::$app->db->beginTransaction();

        try {
            $flag = true;
            //si le demandeur doit signer on le met dans les niveaux de signature
            if ($demande->OWNER_SIGN == 1) {
                $owner = new Niveau();
                $owner->IDENTIFIANT = $demande->IDENTIFIANT;
                $owner->ID_HABILITE = $demande->ID_HABILITE;
                $owner->ID_DEMANDE = $demande->ID_DEMANDE;
                if ($demande->hABILITE->SERVICE_RESP == 1) {
                    $owner->NUM_ORDRE = -1;
                } else {
                    $owner->NUM_ORDRE = 0;
                }
                $owner->ID_SERVICE = -1;
                $owner->DATE_TRAITEMENT = date('Y-m-d H:i:s');
                $owner->ID_ETAT = EtatDemande::findOne(['NOM_ETAT' => "EN ATTENTE"])->ID_ETAT;
                $owner->ACTIF = 1;
                $owner->save();
            }
            //si le responsable du service de l'utilisateur doit signer on le met dans les niveaux de signature
            if ($demande->hABILITE->SERVICE_RESP == 1) {
                $ser_resp = new Niveau();
                $ser_resp->IDENTIFIANT = $demande->IDENTIFIANT;
                $ser_resp->ID_HABILITE = $demande->ID_HABILITE;
                $ser_resp->ID_DEMANDE = $demande->ID_DEMANDE;
                $ser_resp->NUM_ORDRE = 0;
                $ser_resp->ID_SERVICE = $demande->eNTIFIANT->ID_SERVICE;
                $ser_resp->DATE_TRAITEMENT = date('Y-m-d H:i:s');
                $ser_resp->ID_ETAT = EtatDemande::findOne(['NOM_ETAT' => "EN ATTENTE"])->ID_ETAT;
                if ($demande->OWNER_SIGN != 1) {
                    $ser_resp->ACTIF = 1;
                } else {
                    $ser_resp->ACTIF = 0;
                }
                $ser_resp->save();
            }
            //on ajoute ensuite les validateurs sur l'habilitation
            $none_niveau = new Niveau();
            foreach ($validers as $item => $valider) {
                $niveau = new Niveau();
                $niveau->IDENTIFIANT = $demande->IDENTIFIANT;
                $niveau->ID_HABILITE = $demande->ID_HABILITE;
                $niveau->ID_DEMANDE = $demande->ID_DEMANDE;
                $niveau->NUM_ORDRE = $valider->NUM_ORDRE;
                $niveau->ID_SERVICE = $valider->ID_SERVICE;
                $niveau->DATE_TRAITEMENT = date('Y-m-d H:i:s');
                $niveau->ID_ETAT = EtatDemande::findOne(['NOM_ETAT' => "EN ATTENTE"])->ID_ETAT;

                if ($demande->OWNER_SIGN != 1 && $demande->hABILITE->SERVICE_RESP != 1) {
                    if ($item == 0) {
                        $none_niveau = $niveau;
                        $niveau->ACTIF = 1;
                    } else {
                        $niveau->ACTIF = 0;
                    }
                }

                $flag = $niveau->save() && $flag;
            }
            if ($flag) {
                $transaction->commit();
                if ($demande->OWNER_SIGN == 1) {
                    $next_signer = $owner->eNTIFIANT->eNTIFIANT;
                    $niv = $owner;
                } elseif ($demande->hABILITE->SERVICE_RESP == 1) {
                    $next_signer = Service::findOne([
                        'ID_SERVICE' => $ser_resp->ID_SERVICE
                    ])->eNTIFIANT;
                    $niv = $ser_resp;
                } else {
                    $next_signer = $validers[0];
                    $next_signer = $next_signer->sERVICE->eNTIFIANT;
                    $niv = $none_niveau;
                }
                $isSend = Utils::notificateAndSendEmail($next_signer, $demande, $niv);
            } else {
                $transaction->rollBack();
                Yii::$app->session->setFlash('danger', "Une erreur est survenue dans la création des niveaux de validation. Veuillez contacter l'administrateur");
            }

        } catch (\Exception $exception) {
            Yii::$app->session->setFlash('danger', "Une erreur est survenue dans la création des niveaux de validation :" . $exception->getMessage() . " Veuillez contacter l'administrateur");
            $transaction->rollBack();
        }
    }

    /**
     * Updates an existing Demande model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $IDENTIFIANT
     * @param integer $ID_HABILITE
     * @param integer $ID_DEMANDE
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     * @throws Exception
     */
    public function actionUpdate($IDENTIFIANT, $ID_HABILITE, $ID_DEMANDE)
    {
        $model = $this->findModel($IDENTIFIANT, $ID_HABILITE, $ID_DEMANDE);

        if ($model->load(Yii::$app->request->post())) {
            $model->ETAT_DEMANDE = "CREE";
            $model->DATE_DEMANDE = date('Y-m-d H:i:s');

            $filePath = $this->demandeFileHelper($model);

            $model->SOURCE_DEMANDE = $filePath;
            if ($model->save()) {
                $deletable = Niveau::deleteAll(['ID_DEMANDE' => $model->ID_DEMANDE, 'ID_HABILITE' => $model->ID_HABILITE]);
                $this->createNiveau($model);
                return $this->redirect(['view', 'IDENTIFIANT' => $model->IDENTIFIANT, 'ID_HABILITE' => $model->ID_HABILITE, 'ID_DEMANDE' => $model->ID_DEMANDE]);
            }
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Demande model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $IDENTIFIANT
     * @param integer $ID_HABILITE
     * @param integer $ID_DEMANDE
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function actionDelete($IDENTIFIANT, $ID_HABILITE, $ID_DEMANDE)
    {
        $this->findModel($IDENTIFIANT, $ID_HABILITE, $ID_DEMANDE)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Demande model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $IDENTIFIANT
     * @param integer $ID_HABILITE
     * @param integer $ID_DEMANDE
     * @return Demande the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($IDENTIFIANT, $ID_HABILITE, $ID_DEMANDE)
    {
        if (($model = Demande::findOne(['IDENTIFIANT' => $IDENTIFIANT, 'ID_HABILITE' => $ID_HABILITE, 'ID_DEMANDE' => $ID_DEMANDE])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'La page que vous demandez n\'existe pas.'));
    }

    public function actionGetContent($id)
    {
        $id = intval($id);

        $habilite = Habilitation::findOne(['ID_HABILITE' => $id]);
        Yii::$app->response->format = Response::FORMAT_JSON;
        return $habilite;
    }
}
