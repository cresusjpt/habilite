<?php
/**
 * Created by IntelliJ IDEA.
 * User: Simone Sika
 * Date: 16/08/2019
 * Time: 10:13
 */

namespace app\controllers;


use app\models\Demande;
use app\models\Niveau;
use app\models\Notification;
use app\models\SysParam;
use app\models\Utilisateur;
use Exception;
use jSignature_Tools_Base30;
use Yii;
use yii\helpers\FileHelper;
use yii\helpers\Url;

require_once Yii::$app->basePath . DIRECTORY_SEPARATOR . 'web' . DIRECTORY_SEPARATOR . 'signaturef' . DIRECTORY_SEPARATOR . 'extras' . DIRECTORY_SEPARATOR . 'SignatureDataConversion_PHP' . DIRECTORY_SEPARATOR . 'core' . DIRECTORY_SEPARATOR . 'jSignature_Tools_Base30.php';

class Utils
{
    /**
     * @throws \yii\base\Exception
     */
    public static function getCertificatDir()
    {
        $directory = Yii::$app->basePath . DIRECTORY_SEPARATOR . 'web' . DIRECTORY_SEPARATOR . 'certificats' . DIRECTORY_SEPARATOR;
        if (!is_dir($directory))
            FileHelper::createDirectory($directory);

        return $directory;
    }

    /**
     * @param $scheme
     * @return string
     */
    public static function getCertificatUrl($scheme)
    {
        $path = Url::base($scheme) . '/' . 'certificats' . '/';
        return $path;
    }

    /**
     * @throws \yii\base\Exception
     */
    public static function getDemandeDir()
    {
        $directory = Yii::$app->basePath . DIRECTORY_SEPARATOR . 'web' . DIRECTORY_SEPARATOR . SysParam::findOne('UPLOADS_DIR_NAME')->PARAM_VALUE . DIRECTORY_SEPARATOR . SysParam::findOne('DEMANDE_DIR_NAME')->PARAM_VALUE . DIRECTORY_SEPARATOR;
        if (!is_dir($directory))
            FileHelper::createDirectory($directory);

        return $directory;
    }

    /**
     * @throws \yii\base\Exception
     */
    public static function getFinalDemandeDir()
    {
        $directory = Yii::$app->basePath . DIRECTORY_SEPARATOR . 'web' . DIRECTORY_SEPARATOR . 'explorer/data/Group/public/home/demandes' . DIRECTORY_SEPARATOR;
        if (!is_dir($directory))
            FileHelper::createDirectory($directory);

        return $directory;
    }

    /**
     * @param $scheme
     * @return string
     */
    public static function getDemandeUrl($scheme)
    {
        $directory = Url::base($scheme) . '/' . SysParam::findOne('UPLOADS_DIR_NAME')->PARAM_VALUE . '/' . SysParam::findOne('DEMANDE_DIR_NAME')->PARAM_VALUE . '/';

        return $directory;
    }


    /**
     * @throws \yii\base\Exception
     */
    public static function getPPDir()
    {
        $directory = Yii::$app->basePath . DIRECTORY_SEPARATOR . 'web' . DIRECTORY_SEPARATOR . SysParam::findOne('UPLOADS_DIR_NAME')->PARAM_VALUE . DIRECTORY_SEPARATOR . SysParam::findOne('PROFILE_DIR_NAME')->PARAM_VALUE . DIRECTORY_SEPARATOR;
        if (!is_dir($directory))
            FileHelper::createDirectory($directory);

        return $directory;
    }

    /**
     * @param $scheme
     * @return string
     */
    public static function getPPUrl($scheme)
    {
        $directory = Url::base($scheme) . '/' . SysParam::findOne('UPLOADS_DIR_NAME')->PARAM_VALUE . '/' . SysParam::findOne('PROFILE_DIR_NAME')->PARAM_VALUE . '/';

        return $directory;
    }


    /**
     * @return string
     * @throws \yii\base\Exception
     */
    public static function getTmpDir()
    {
        $directory = Yii::$app->basePath . DIRECTORY_SEPARATOR . 'web' . DIRECTORY_SEPARATOR . SysParam::findOne('UPLOADS_DIR_NAME')->PARAM_VALUE . DIRECTORY_SEPARATOR . SysParam::findOne('TMP_DIR_NAME')->PARAM_VALUE . DIRECTORY_SEPARATOR;
        if (!is_dir($directory))
            FileHelper::createDirectory($directory);

        return $directory;
    }

    /**
     * @param $scheme
     * @return string
     */
    public static function getTmpUrl($scheme)
    {
        $directory = Url::base($scheme) . '/' . SysParam::findOne('UPLOADS_DIR_NAME')->PARAM_VALUE . '/' . SysParam::findOne('TMP_DIR_NAME')->PARAM_VALUE . '/';

        return $directory;
    }

    /**
     * @param $base30_string
     * @return string
     * @throws \yii\base\Exception
     */
    public static function base30_to_jpeg($base30_string)
    {

        $data = str_replace('image/jsignature;base30,', '', $base30_string);
        $converter = new jSignature_Tools_Base30();
        $raw = $converter->Base64ToNative($data);
        //Calculate dimensions
        $width = 0;
        $height = 0;
        foreach ($raw as $line) {
            if (max($line['x']) > $width) $width = max($line['x']);
            if (max($line['y']) > $height) $height = max($line['y']);
        }

        // Create an image
        $im = imagecreatetruecolor($width + 20, $height + 20);

        // Save transparency for PNG
        imagesavealpha($im, true);
        // Fill background with transparency
        $trans_colour = imagecolorallocatealpha($im, 255, 255, 255, 127);
        imagefill($im, 0, 0, $trans_colour);
        // Set pen thickness
        imagesetthickness($im, 2);
        // Set pen color to black
        $black = imagecolorallocate($im, 0, 0, 0);
        // Loop through array pairs from each signature word
        for ($i = 0; $i < count($raw); $i++) {
            // Loop through each pair in a word
            for ($j = 0; $j < count($raw[$i]['x']); $j++) {
                // Make sure we are not on the last coordinate in the array
                if (!isset($raw[$i]['x'][$j]))
                    break;
                if (!isset($raw[$i]['x'][$j + 1]))
                    // Draw the dot for the coordinate
                    imagesetpixel($im, $raw[$i]['x'][$j], $raw[$i]['y'][$j], $black);
                else
                    // Draw the line for the coordinate pair
                    imageline($im, $raw[$i]['x'][$j], $raw[$i]['y'][$j], $raw[$i]['x'][$j + 1], $raw[$i]['y'][$j + 1], $black);
            }
        }

        //Create Image
        $output_file = self::getTmpDir();
        $filename = 'sign' . (time() + 1) . '.png';
        $string = $output_file . DIRECTORY_SEPARATOR . $filename;

        $ifp = fopen($string, "w+");
        imagepng($im, $string);
        fclose($ifp);
        imagedestroy($im);

        return $filename;
    }


    /**
     * @param Utilisateur $user
     * @param Demande $demande
     * @param string $attach_fileName
     * @return bool
     * @throws \yii\base\InvalidConfigException
     */
    public static function notificateAndSendEmail(Utilisateur $user, Demande $demande, Niveau $niv, $attach_fileName = "")
    {
        $nom = $demande->eNTIFIANT->NOM;
        $nom_f = $user->NOM;
        $nom_habilite = $demande->hABILITE->NOM_HABILITE;
        $dt = Yii::$app->formatter->asDatetime($demande->DATE_DEMANDE);

        try {
            //un probleme lors de l'envoi du model niveau, ici on ajoute ID_SERVICE à l'user puisque c'est le seul dont j'ai besoin dans le mail
            $user->ID_SERVICE = $niv->ID_SERVICE;
            $mailer = @Yii::$app->mailer->compose('next_signer', [
                'demande' => $demande,
                'user' => $user,
            ]);

            $mailer->setFrom([SysParam::findOne(['PARAM_CODE' => 'APP_EMAIL'])->PARAM_VALUE => SysParam::findOne(['PARAM_CODE'=>'APP_NAME'])->PARAM_VALUE])
                ->setTo([$user->EMAIL => $user->NOM])
                ->setSubject("Habilite : Demande d'habilitation en attente")
                ->setBcc(['tossoujeanpaul641@gmail.com' => 'Jeanpaul Tossou']);
            //->setHtmlBody($html_body);

            if (!empty($attach_fileName)) {
                $mailer->attach($attach_fileName);
            }

            if ($mailer->send()) {
                $notif = new Notification();
                $for = $demande->eNTIFIANT->NOM;
                $notif->IDENTIFIANT = $user->IDENTIFIANT;
                $notif->ACTIF = 1;
                $notif->ID_DEMANDE = $demande->ID_DEMANDE;
                $notif->MESSAGE = "Vous avez une Demande : $nom_habilite en attente de la part de $for";

                if ($notif->save()) {
                    return true;
                } else {
                    return false;
                }
            } else {
                return false;
            }

        } catch (\Swift_SwiftException $swiftException) {
            Yii::$app->session->setFlash('danger', "Une erreur s'est produite lors de l'envoie des mails aux différents signataire Vérifiez votre acces aux mails\n" . $swiftException->getMessage());
            return false;
        } catch (Exception $exception) {
            Yii::$app->session->setFlash('danger', "Une erreur s'est produite lors de l'envoie des mails aux différents signataire Vérifiez votre acces aux mails\n" . $exception->getMessage());
            return false;
        }

    }

    public static function rrmdir($dir) {
        try{
            if (is_dir($dir)) {
                $objects = scandir($dir);
                foreach ($objects as $object) {
                    if ($object != "." && $object != "..") {
                        if (filetype($dir."/".$object) == "dir") self::rrmdir($dir."/".$object); else unlink($dir."/".$object);
                    }
                }
                reset($objects);
                rmdir($dir);
            }
        }catch (Exception $exception){

        }
    }
}
