<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\EtatDemande */

$this->title = Yii::t('app', 'Update Etat Demande: {name}', [
    'name' => $model->ID_ETAT,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Etat Demandes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->ID_ETAT, 'url' => ['view', 'id' => $model->ID_ETAT]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="etat-demande-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
