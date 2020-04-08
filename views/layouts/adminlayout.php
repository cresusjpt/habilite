<?php
/* @var $this \yii\web\View */

use app\assets\AdminAppAsset;
use yii\helpers\Html;
use app\models\SysParam;

/* @var $content string */

AdminAppAsset::register($this);

$profile_dir = \app\controllers\Utils::getPPUrl(true);
$user = Yii::$app->user->identity;
$fonctionnalites = \app\models\Fonctionnalite::find()->orderBy('NUM_ORDREFONCT ASC')->all();
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>

<body class="theme-red">
<?php $this->beginBody() ?>
<!-- Page Loader -->
<div class="page-loader-wrapper">
    <div class="loader">
        <div class="preloader">
            <div class="spinner-layer pl-red">
                <div class="circle-clipper left">
                    <div class="circle"></div>
                </div>
                <div class="circle-clipper right">
                    <div class="circle"></div>
                </div>
            </div>
        </div>
        <p>Patientez quelques secondes svp...</p>
    </div>
</div>
<!-- #END# Page Loader -->
<!-- Top Bar -->
<nav class="navbar">
    <div class="container-fluid">
        <div class="navbar-header">
            <a href="javascript:void(0);" class="navbar-toggle collapsed" data-toggle="collapse"
               data-target="#navbar-collapse" aria-expanded="false"></a>
            <a href="javascript:void(0);" class="bars"></a>
            <a class="navbar-brand" href="<?= \yii\helpers\Url::toRoute(('site/index')) ?>"><?=SysParam::findOne(['PARAM_CODE' => 'APP_NAME'])->PARAM_VALUE?></a>
        </div>
        <div class="collapse navbar-collapse" id="navbar-collapse">
            <ul class="nav navbar-nav navbar-right">
                <li><a href="<?= \yii\helpers\Url::toRoute(['site/logout']) ?>" data-method="post" data-close="true"><i
                                class="material-icons">input</i>Deconnéxion</a></li>
                <li class="pull-right"><a href="javascript:void(0);" class="js-right-sidebar" data-close="true"><i
                                class="material-icons">more_vert</i></a></li>
            </ul>
        </div>
    </div>
</nav>
<!-- #Top Bar -->
<section>
    <!-- Left Sidebar -->
    <aside id="leftsidebar" class="sidebar">
        <!-- User Info -->
        <div class="user-info">
            <div class="image">
                <img src="<?= $profile_dir . 'anonymous.jpg' ?>" width="48" height="48" alt="User"/>
            </div>
            <div class="info-container">
                <div class="name" data-toggle="dropdown" aria-haspopup="true"
                     aria-expanded="false"><?= $user->NOM ?></div>
                <div class="email"><?= $user->EMAIL ?></div>
            </div>
        </div>
        <!-- #User Info -->
        <!-- Menu -->
        <div class="menu">
            <ul class="list">
                <li class="header">Fonctionnalités</li>
                <li class="active">
                    <a href="<?= \yii\helpers\Url::toRoute(('site/index')) ?>">
                        <i class="material-icons">home</i>
                        <span>Acceuil</span>
                    </a>
                </li>
                <?php
                foreach ($fonctionnalites as $item => $fonctionnalite) {
                    ?>
                    <li>
                        <a href="<?=\yii\helpers\Url::toRoute([$fonctionnalite->FOCNT_URL])?>" class="menu-toggle">
                            <i class="material-icons"><?=$fonctionnalite->ICONE_FONCT ?></i>
                            <span><?=$fonctionnalite->LIBEL_FONCT ?></span>
                        </a>
                    </li>
                    <?php
                }
                ?>
                <li class="header">Autres</li>
                <li>
                    <a href="<?=\yii\helpers\Url::toRoute(['site/explorer'])?>">
                        <i class="material-icons col-blue">donut_large</i>
                        <span>Explorateur des demandes</span>
                    </a>
                </li>
                <li>
                    <a href="<?= \yii\helpers\Url::toRoute(['site/stats'])?>">
                        <i class="material-icons col-amber">donut_large</i>
                        <span>Statistiques</span>
                    </a>
                </li>
                <li>
                    <a href="<?=\yii\helpers\Url::toRoute(['site/logout']) ?>" data-method="post">
                        <i class="material-icons col-red">donut_large</i>
                        <span>Deconnexion</span>
                    </a>
                </li>
            </ul>
        </div>
        <!-- #Menu -->
        <!-- Footer -->
        <div class="legal">
            <div class="copyright">
                &copy; <?= date('Y') ?> <a href="javascript:void(0);" class="pull-right">Banque Atlantique Togo -
                    jpT</a>.
            </div>
        </div>
        <!-- #Footer -->
    </aside>
    <!-- #END# Left Sidebar -->
    <!-- Right Sidebar -->
    <aside id="rightsidebar" class="right-sidebar">
        <ul class="nav nav-tabs tab-nav-right" role="tablist">
            <li role="presentation" class="active"><a href="#theme" data-toggle="tab"></a></li>
        </ul>
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane fade in active in active" id="theme">
                <ul class="demo-choose-skin">
                    <li data-theme="red" class="active">
                        <div class="red"></div>
                        <span>Rouge</span>
                    </li>
                    <li data-theme="pink">
                        <div class="pink"></div>
                        <span>Rose</span>
                    </li>
                    <li data-theme="purple">
                        <div class="purple"></div>
                        <span>Violet</span>
                    </li>
                    <li data-theme="deep-purple">
                        <div class="deep-purple"></div>
                        <span>Viloet Foncé</span>
                    </li>
                    <li data-theme="indigo">
                        <div class="indigo"></div>
                        <span>Indigo</span>
                    </li>
                    <li data-theme="blue">
                        <div class="blue"></div>
                        <span>Bleu</span>
                    </li>
                    <li data-theme="light-blue">
                        <div class="light-blue"></div>
                        <span>Bleu Clair</span>
                    </li>
                    <li data-theme="cyan">
                        <div class="cyan"></div>
                        <span>Cyan</span>
                    </li>
                    <li data-theme="teal">
                        <div class="teal"></div>
                        <span>Sarcelle</span>
                    </li>
                    <li data-theme="green">
                        <div class="green"></div>
                        <span>Vert</span>
                    </li>
                    <li data-theme="light-green">
                        <div class="light-green"></div>
                        <span>Vert Clair</span>
                    </li>
                    <li data-theme="lime">
                        <div class="lime"></div>
                        <span>Vert Citron</span>
                    </li>
                    <li data-theme="yellow">
                        <div class="yellow"></div>
                        <span>Jaune</span>
                    </li>
                    <li data-theme="amber">
                        <div class="amber"></div>
                        <span>Ambre</span>
                    </li>
                    <li data-theme="orange">
                        <div class="orange"></div>
                        <span>Orange</span>
                    </li>
                    <li data-theme="deep-orange">
                        <div class="deep-orange"></div>
                        <span>Orange Foncé</span>
                    </li>
                    <li data-theme="brown">
                        <div class="brown"></div>
                        <span>Marron</span>
                    </li>
                    <li data-theme="grey">
                        <div class="grey"></div>
                        <span>Gris</span>
                    </li>
                    <li data-theme="blue-grey">
                        <div class="blue-grey"></div>
                        <span>Bleu Gris</span>
                    </li>
                    <li data-theme="black">
                        <div class="black"></div>
                        <span>Noir</span>
                    </li>
                </ul>
            </div>
        </div>
    </aside>
    <!-- #END# Right Sidebar -->
</section>

<section class="content">

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

    <div class="container-fluid">
        <?= $content ?>
    </div>
</section>
<?php $this->endBody() ?>
</body>
<?php $this->endPage() ?>
</html>