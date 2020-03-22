<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Niveau */

$this->title = $model->NUM_ORDRE;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Niveaus'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="niveau-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'eNTIFIANT.eNTIFIANT.NOM',
            'eNTIFIANT.hABILITE.NOM_HABILITE',
            'eTAT.NOM_ETAT',
            'sERVICE.NOM_SERVICE',
            'COMMENTAIRE_NIVEAU',
            'NUM_ORDRE:integer',
        ],
    ]) ?>

</div>
