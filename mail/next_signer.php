<?php
/**
 * Created by IntelliJ IDEA.
 * User: Jeanpaul Tossou
 * Date: 28/08/2019
 * Time: 15:42
 */

use yii\helpers\Url;
use app\models\SysParam;

/* @var $demande app\models\Demande */
/* @var $user app\models\Utilisateur */
/* @var $niveau app\models\Niveau */

$url = Url::to(['niveau/valid', 'ID_HABILITE' => $demande->hABILITE->ID_HABILITE, 'ID_SERVICE' => $user->ID_SERVICE, 'ID_DEMANDE' => $demande->ID_DEMANDE],true);
?>
<!-- START CENTERED WHITE CONTAINER -->
<table role="presentation" class="main">
    <!-- START MAIN CONTENT AREA -->
    <tr>
        <td class="wrapper">
            <table role="presentation" border="0" cellpadding="0" cellspacing="0">
                <tr>
                    <td>
                        <p>Bonjour <?= $user->NOM ?>,</p>
                        <p>Vous avez une fiche
                            : <?= $demande->hABILITE->NOM_HABILITE ?> en attente de validation de la part
                            de <?= $demande->eNTIFIANT->NOM ?>
                            du <?= Yii::$app->formatter->asDate($demande->DATE_DEMANDE) ?>
                            .
                            Vous pouvez le consultez en allant dans l&rsquo;application <?=SysParam::findOne(['PARAM_CODE' => 'APP_NAME'])->PARAM_VALUE?>, puis dans le menu
                            Validation ou en
                            cliquant sur le bouton ci-dessous.
                        </p>
                        <table role="presentation" border="0" cellpadding="0" cellspacing="0" class="btn btn-primary">
                            <tbody>
                            <tr>
                                <td align="left">
                                    <table role="presentation" border="0" cellpadding="0" cellspacing="0">
                                        <tbody>
                                        <tr>
                                            <td><a href="<?= $url ?>" target="_blank">Valider...</a></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                        <p>
                            Merci pour votre compr&eacute;hension et pour la diligence habituelle dont vous faites preuves. Cordialement.
                        </p>
                    </td>
                </tr>
            </table>
        </td>
    </tr>

    <!-- END MAIN CONTENT AREA -->
</table>
<!-- END CENTERED WHITE CONTAINER -->
