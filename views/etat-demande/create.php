<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\EtatDemande */

$this->title = Yii::t('app', 'Ajouter Etat Demande');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Etat Demandes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="etat-demande-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
