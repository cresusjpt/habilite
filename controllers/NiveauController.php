<?php

namespace app\controllers;

use app\models\Demande;
use app\models\EtatDemande;
use app\models\Notification;
use app\models\Service;
use app\models\Signature;
use app\models\Utilisateur;
use Yii;
use app\models\Niveau;
use app\models\NiveauSearch;
use yii\base\Exception;
use yii\base\UserException;
use yii\db\Query;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;

require_once Yii::$app->basePath . DIRECTORY_SEPARATOR . 'web' . DIRECTORY_SEPARATOR . 'php-mac' . DIRECTORY_SEPARATOR . 'src' . DIRECTORY_SEPARATOR . 'BlakeGardner' . DIRECTORY_SEPARATOR . 'MacAddress.php';

use BlakeGardner\MacAddress;

/**
 * NiveauController implements the CRUD actions for Niveau model.
 */
class NiveauController extends HController
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

    public function getHost()
    {
        ob_start();
        system('hostname');
        $hostname = ob_get_contents();
        ob_clean();
        return $hostname;
    }

    public function getMac()
    {
        ob_start();
        system('ipconfig/all');
        $mycom = ob_get_contents();
        ob_clean();
        return $mycom;
    }

    /**
     * Lists all Niveau models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new NiveauSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Lists all Niveau models.
     * @return mixed
     */
    public function actionValidation()
    {
        $searchModel = new NiveauSearch();
        $dataProvider = $searchModel->searchForMe(Yii::$app->request->queryParams);

        return $this->render('validation', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Niveau model.
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
     * Creates a new Niveau model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Niveau();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->ID_NIVEAU]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    public function actionValidUpdate()
    {
        if (isset($_POST['id_demande'], $_POST['identifiant'])) {
            $model = Demande::findOne(['ID_DEMANDE' => $_POST['id_demande'], 'IDENTIFIANT' => $_POST['identifiant']]);
            try {
                $dest = Utils::getDemandeDir() . $model->SOURCE_DEMANDE;
                if (move_uploaded_file($_FILES['pdf']['tmp_name'], $dest)) {
                    Utils::rrmdir(Utils::getTmpDir());
                    return true;
                }
            } catch (Exception $e) {

            }

        }
        return false;

    }

    public function actionWord()
    {
        $word = new \COM("word.application") or die("Impossible de démarrer le composasnt word");

        $word->Visible = 0;
        $word->Documents->Open("C:\Users\Simone Sika\Desktop\Saltech digital\habilite\web\HAB\df.doc");

        $word->Documents[1]->SaveAs("C:\Users\Simone Sika\Desktop\Saltech digital\habilite\web\doc_text.html", 8);

        $word->Quit();
        //$word->Release();
        $word = null;
    }

    public function actionAuthenticateSigner()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $post = Yii::$app->request->post();
        if (isset($post['password'])) {
            $password = $post['password'];
            $user = Utilisateur::findOne(['IDENTIFIANT' => Yii::$app->user->id]);

            return $user->validatePassword($password);
        } else {
            return false;
        }
    }

    /**
     * Creates a new Niveau model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     * @throws \yii\base\Exception
     * @throws \Throwable
     */
    public function actionValid($ID)
    {
        $model = Niveau::findOne(['ID_NIVEAU' => $ID]);
        if ($model == null) {
            throw new UserException("Aucune validation de ce type dans le système. Rééessayez ultérieurement.");
        }
        if ($model->ID_ETAT == EtatDemande::findOne(['NOM_ETAT'=>'OK'])->ID_ETAT || $model->ID_ETAT == EtatDemande::findOne(['NOM_ETAT'=>'NOK'])->ID_ETAT ){
            throw new UserException("Vous avez déjà donné votre avis sur cette fiche.");
        }
        $model->ID_ETAT = EtatDemande::findOne(['NOM_ETAT' => 'OK'])->ID_ETAT;

        $modelDemande = Demande::findOne(['ID_DEMANDE' => $model->ID_DEMANDE]);
        if ($model->ID_SERVICE == -1) {
            $signataire = $modelDemande->eNTIFIANT;
        } else {
            $signataire = Service::findOne(['ID_SERVICE' => $model->ID_SERVICE])->eNTIFIANT;
        }

        $signature = Signature::findOne(['IDENTIFIANT' => $signataire->IDENTIFIANT, 'ACTIF' => 1]);

        if ($signature == null) {
            Yii::$app->session->setFlash('danger', "$signataire->NOM n'a pas de signature active dans le système ! Veuillez en ajouter une pour pouvoir continuer.");
            throw new UserException();
        }

        $signature_image = Utils::base30_to_jpeg($signature->CONTENU_SIGNATURE);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            $model->ACTIF = 0;
            $model->IP_ADDRESS = $_SERVER['REMOTE_ADDR'];
            $model->MAC_ADDRESS = $this->getMac();
            $model->HOSTNAME = $this->getHost();
            $model->save();
            if ($model->ID_ETAT == EtatDemande::findOne(['NOM_ETAT' => 'OK'])->ID_ETAT) {

                $niveaus = (new Query())
                    ->from(Niveau::tableName())
                    ->where(['<>', 'ID_NIVEAU', $model->ID_NIVEAU])
                    ->andWhere(['ID_HABILITE' => $model->ID_HABILITE])
                    ->andWhere(['ID_DEMANDE' => $model->ID_DEMANDE])
                    ->andWhere(['ID_ETAT' => EtatDemande::findOne(['NOM_ETAT' => 'EN ATTENTE'])->ID_ETAT])
                    ->orderBy('NUM_ORDRE ASC')
                    ->limit(1)
                    ->one();


                //s'il y a une autre etape de validation
                if ($niveaus != null) {
                    $service = Service::findOne(['ID_SERVICE' => $niveaus['ID_SERVICE']]);
                    $next_signer = $service->eNTIFIANT;
                    if ($next_signer != null) {
                        $modelDemande->ETAT_DEMANDE = "EN COURS";
                        $modelDemande->save();

                        //On actif le prohain niveau
                        $to_active = Niveau::findOne([
                            'ID_NIVEAU' => $niveaus['ID_NIVEAU'],
                        ]);
                        $to_active->ACTIF = 1;
                        $to_active->update(false);

                        //envoyer Notification et email au prochain signataire.
                        $bool = Utils::notificateAndSendEmail($next_signer, $modelDemande, $to_active);
                    } else {
                        Yii::$app->session->setFlash('warning', "Le prochain service de validation : $service->NOM_SERVICE n'a pas de responsable actif dans le système ! Veuillez contacter l'dministrateur");
                        throw new UserException();
                    }
                } else {//sinon
                    $demande_actu = Utils::getDemandeDir();
                    $demande_final = Utils::getFinalDemandeDir();

                    rename($demande_actu . $modelDemande->SOURCE_DEMANDE, $demande_final . $modelDemande->SOURCE_DEMANDE);
                    $modelDemande->DATE_TRAITEMENT = date('Y-m-d H:i:s');
                    $modelDemande->ETAT_DEMANDE = "TERMINEE";
                    $modelDemande->save();
                    //TODO: Notifier le demandeur de la fin de validation de sa demande
                }
            } else {
                $modelDemande->DATE_TRAITEMENT = date('Y-m-d H:i:s');
                $modelDemande->ETAT_DEMANDE = "REFUSEE";
                $modelDemande->save();
                //TODO: Notifier l'utilisateur du refus de signer.
            }

            $notif = Notification::findOne(['ID_DEMANDE' => $modelDemande->ID_DEMANDE]);
            if ($notif != null) {
                $notif->ACTIF = 0;
                if (!$notif->save()) {
                    var_dump($notif->getErrors());
                    die();
                }
            }
            return $this->redirect(['view', 'id' => $model->ID_NIVEAU]);
        }

        Yii::$app->session->setFlash('info', "Pour valider vous devez mettre l'état à Ok et apposer votre signature et éventuellement le nom et la date !");

        return $this->render('_valid_niveau', [
            'model' => $model,
            'demande' => $modelDemande,
            'signataire' => $signataire,
            'image' => $signature_image,
            'signature' => $signature,
        ]);
    }

    /**
     * Updates an existing Niveau model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->ID_NIVEAU]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Niveau model.
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
     * Finds the Niveau model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Niveau the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Niveau::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', "La page que vous demandez n'existe pas."));
    }
}
