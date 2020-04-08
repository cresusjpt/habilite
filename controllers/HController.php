<?php
/**
 * Created by IntelliJ IDEA.
 * User: Simone Sika
 * Date: 22/08/2019
 * Time: 17:14
 */

namespace app\controllers;


use app\models\Utilisateur;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class HController extends Controller
{
    public $user_role = [
        'demande/my-create',
        'demande/view',
        'demande/update',
        'niveau/validation',
        'niveau/valid',
        'niveau/view',
        'signature/mes-signature',
        'signature/my-create',
        'signature/view',
        'signature/delete',
    ];

    /**
     * @param \yii\base\Action $action
     * @return bool
     * @throws \yii\web\ForbiddenHttpException
     * @throws NotFoundHttpException
     */
    public function beforeAction($action)
    {
        if (Yii::$app->user->isGuest && Yii::$app->controller->action->id != "login" && Yii::$app->controller->action->id != "register") {
            Yii::$app->user->loginRequired();
        }

        if (!Yii::$app->user->isGuest && !Yii::$app->request->isAjax && Yii::$app->controller->id != 'site') {
            $route = Yii::$app->controller->id . '/' . Yii::$app->controller->action->id;
            $user = Utilisateur::findOne([
                'IDENTIFIANT' => Yii::$app->user->id,
            ]);
            $profils = $user->cODEPROFILs;
            $profil = $profils[0]->LIBELLE;

            if ($profil == "USER"){
                if (!in_array($route, $this->user_role)) {
                    throw new NotFoundHttpException("Vous n'avez pas le profil nécessaire pour accéder à cette page");
                }
            }
        }

        return true;
    }

}