<?php

/* @var $this \yii\web\View */

/* @var $content string */

use app\models\SysParam;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="initial-scale=1.0, width=device-height">
    <!--  mobile Safari, FireFox, Opera Mobile  -->
    <meta content="application,suivi,habilitations,systèmes,informatiques,signature,electronique,numérique"
          name="description"/>
    <meta content="Jeanpaul Tossou" name="author"/>
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php
    echo "<!--[if lt IE 9]>" . "\n\t\t";
    echo "<script type=\"text/javascript\" src=\"" . \yii\helpers\Url::to(['/signaturef/libs/flashcanvas.js']);
    echo "\"></script>";
    echo "\n\t" . "<![endif]-->";
    ?>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => SysParam::findOne(['PARAM_CODE' => 'APP_NAME'])->PARAM_VALUE,
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => [
            ['label' => 'Validation', 'url' => ['/niveau/validation']],
            ['label' => 'Signature', 'url' => ['/signature/mes-signature']],
            ['label' => 'Modifier Profil', 'url' => ['/site/profil']],
            Yii::$app->user->isGuest ? (
            ['label' => 'Connexion', 'url' => ['/site/login']]
            ) : (
                '<li>'
                . Html::beginForm(['/site/logout'], 'post')
                . Html::submitButton(
                    'Deconnexion',
                    ['class' => 'btn btn-link logout']
                )
                . Html::endForm()
                . '</li>'
            )
        ],
    ]);
    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>

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

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; Banque Atlantique <?= date('Y') ?></p>

        <p class="pull-right">
            <?php
            if (!Yii::$app->user->isGuest) {
                echo "\tConnecté : " . Yii::$app->user->identity->USERNAME . ' | ' . Yii::$app->user->identity->NOM . ' | ';
            }
            ?>
            <?= "By jpT" ?>
        </p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
