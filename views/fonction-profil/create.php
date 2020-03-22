<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\FonctionProfil */

$this->title = Yii::t('app', 'Ajouter Fonctionnalités a un Profil');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Fonction Profils'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="fonction-profil-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
