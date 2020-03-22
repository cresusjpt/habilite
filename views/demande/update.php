<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Demande */

$this->title = Yii::t('app', 'Modifier Demande: {name}', [
    'name' => $model->hABILITE->NOM_HABILITE.' '.$model->eNTIFIANT->NOM.' '.$model->DATE_DEMANDE,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Demandes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->IDENTIFIANT, 'url' => ['view', 'IDENTIFIANT' => $model->IDENTIFIANT, 'ID_HABILITE' => $model->ID_HABILITE, 'ID_DEMANDE' => $model->ID_DEMANDE]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Modifier');
?>
<div class="demande-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
