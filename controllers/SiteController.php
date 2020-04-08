<?php

namespace app\controllers;

use app\models\Demande;
use app\models\DemandeSearch;
use app\models\Niveau;
use app\models\Profil;
use app\models\Service;
use app\models\User;
use app\models\UserProfil;
use app\models\Utilisateur;
use Yii;
use yii\filters\AccessControl;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

class SiteController extends HController
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionExplorer()
    {
        return $this->render('explorer');
    }

    public function actionStats(){
        return $this->render('test');
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(['site/login']);
        }

        $searchModel = new DemandeSearch();
        $dataProvider = $searchModel->searchForMe(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionLogine()
    {
        $this->layout = 'loginlayout';

        return $this->render('test');
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        $this->layout = 'loginlayout';
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    public function actionProfil()
    {
        $responsable_service = Service::findAll(['IDENTIFIANT' => Yii::$app->user->id]);

        $model = Yii::$app->user->identity;
        $demande = Demande::findAll(['IDENTIFIANT' => Yii::$app->user->id]);
        $validation = Niveau::find();
        foreach ($responsable_service as $service_resp) {
            $validation->orWhere(['ID_SERVICE' => $service_resp->ID_SERVICE]);
        };
        $validation = $validation->all();

        return $this->render('profil', [
            'model' => $model,
            'demandeCount' => count($demande),
            'validationCount'=>count($validation),
        ]);
    }

    /**
     * @return string|Response
     * @throws \yii\base\Exception
     */
    public function actionRegister()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $this->layout = 'loginlayout';
        $model = new Utilisateur();

        if ($model->load(Yii::$app->request->post())) {
            if ($model->isSamePassword($model->rawpassword, $model->PASSWORD)) {
                if ($model->passwordConform($model->rawpassword, Yii::$app->request->queryParams)) {
                    $model->setPassword($model->rawpassword);
                    $model->generateAuthKey();
                    $model->generateAccessToken();
                    $model->ETAT = 'INACTIF';
                    $model->DM_MODIFICATION = date('Y-m-d H:i:s');

                    if ($model->validate() && $model->save()) {
                        //par défaut tous le monde est simple utilisateur
                        $profil = Profil::findOne(['CODE_PROFIL' => 'USER']);

                        if ($profil != null) {
                            $user_profil = new UserProfil();
                            $user_profil->CODE_PROFIL = $profil->CODE_PROFIL;
                            $user_profil->IDENTIFIANT = $model->IDENTIFIANT;
                            $user_profil->save();
                        }

                        Yii::$app->session->setFlash('success', 'Inscription reussie');
                        return $this->redirect(Url::toRoute(['site/login']));
                    } else {
                        var_dump($model->getErrors());
                        die();
                    }

                } else {
                    $model->addError($model->rawpassword, 'Le mot de passe ne répond pas aux exigences établies par votre administrateur.');
                    $model->addError($model->PASSWORD, 'Le mot de passe ne répond pas aux exigences établies par votre administrateur.');
                    Yii::$app->session->setFlash('warning', $model->getErrors($model->rawpassword)[0], false);
                }
            } else {
                $model->addError($model->rawpassword, 'Les deux nouveaux mot de passe ne correspondent pas');
                $model->addError($model->PASSWORD, 'Les deux nouveaux mot de passe ne correspondent pas');
                Yii::$app->session->setFlash('warning', $model->getErrors($model->rawpassword)[0], false);
                //return $this->redirect(['site/register']);
            }
        }

        return $this->render('register', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }
}
