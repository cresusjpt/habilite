<?php
/**
 * Created by IntelliJ IDEA.
 * User: Simone Sika
 * Date: 11/08/2019
 * Time: 03:28
 */

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;

\app\assets\LoginAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">

<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="description" content="Habilite | Login">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
<!--<div id="ms-preload" class="ms-preload">
    <div id="status">
        <div class="spinner">
            <div class="dot1"></div>
            <div class="dot2"></div>
        </div>
    </div>
</div>-->
<div class="bg-full-page ms-hero-bg-dark ms-hero-img-airplane back-fixed bg-dark back-show">
    <div class="mw-500 absolute-center">
        <br>
        <div>
            <?php
            $flash = ['warning', 'success', 'danger', 'info'];
            foreach ($flash as $aFlash) {
                if (Yii::$app->session->hasFlash($aFlash)) {
                    ?>
                    <div class="alert alert-<?= $aFlash ?>">
                        <button data-dismiss="alert" class="close">&times;</button>
                        <strong><?= Yii::$app->session->getFlash($aFlash) ?></strong>
                    </div>
                    <?php
                }
            }
            ?>
        </div>
        <?= $content ?>
    </div>
</div>
<?php $this->endBody() ?>
</body>

</html>
<?php $this->endPage() ?>
