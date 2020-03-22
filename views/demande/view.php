<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Demande */

$this->title = $model->IDENTIFIANT;

\app\assets\LoginAsset::register($this);
\yii\web\YiiAsset::register($this);
?>
<div class="panel panel-body demande-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Modifier'), ['update', 'IDENTIFIANT' => $model->IDENTIFIANT, 'ID_HABILITE' => $model->ID_HABILITE, 'ID_DEMANDE' => $model->ID_DEMANDE], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Supprimer'), ['delete', 'IDENTIFIANT' => $model->IDENTIFIANT, 'ID_HABILITE' => $model->ID_HABILITE, 'ID_DEMANDE' => $model->ID_DEMANDE], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Voulez vous vraiment supprimer l\'élément?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'eNTIFIANT.NOM',
            'hABILITE.NOM_HABILITE',
            'ETAT_DEMANDE',
            'DATE_DEMANDE:datetime',
            'DATE_TRAITEMENT:datetime',
            'SOURCE_DEMANDE',
        ],
    ]) ?>
</div>
<div class="container">
    <h1 class="color-primary text-center mb-4">Niveau de validation</h1>
    <div class="row">
        <div class="col-md-12">
            <ul class="ms-timeline">
                <?php
                $profile_dir = \app\controllers\Utils::getPPUrl(true);
                foreach ($niveaus as $item => $niveau) {
                    if ($item == 0) {
                        $color = "primary";
                    } elseif ($item == 1) {
                        $color = 'royal';
                    } elseif ($item == 2) {
                        $color = "success";
                    } elseif ($item = 3) {
                        $color = "danger";
                    } elseif ($item = 4) {
                        $color = "warning";
                    } elseif ($item = 5) {
                        $color = "warning";
                    } else {
                        $color = "info";
                    }
                    ?>
                    <?php
                        if ($niveau->ID_SERVICE == -1){
                            $service = "Le demandeur";
                            $nom = $niveau->dENTIFIANT->NOM;
                        }else{
                            $service = $niveau->sERVICE->NOM_SERVICE;
                            $nom = $niveau->sERVICE->eNTIFIANT->NOM;
                        }
                    ?>
                    <li class="ms-timeline-item wow materialUp">
                        <div class="ms-timeline-date">
                            <time class="timeline-time" datetime="2017-02-02"><?= Yii::$app->formatter->asDate($niveau->DATE_TRAITEMENT,'Y') ?><span><?= Yii::$app->formatter->asDate($niveau->DATE_TRAITEMENT,'d MMMM') ?></span></time>
                            <i class="ms-timeline-point bg-<?= $color ?>"></i>
                            <img src="<?= $profile_dir.'anonymous.jpg' ?>"
                                 class="ms-timeline-point-img">
                        </div>
                        <div class="card card-<?= $color ?>">
                            <div class="card-header">
                                <h3 class="card-title"><?= $service . ' | ' . $nom ?></h3>
                            </div>
                            <div class="card-body">

                                    <?php
                                    if ($niveau->ACTIF == 1) {
                                        ?>
                                    <div style="color: red;">
                                        A son niveau actuellement
                                    </div>
                                        <?php
                                    }
                                    ?>

                                <?php
                                if (!empty($niveau->COMMENTAIRE_NIVEAU)) {
                                    echo $niveau->COMMENTAIRE_NIVEAU;
                                }
                                ?>
                            </div>
                        </div>
                    </li>
                    <?php
                }
                ?>
            </ul>
        </div>
    </div>
</div> <!-- container -->
