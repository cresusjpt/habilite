<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\FonctionProfil */

$this->title = Yii::t('app', 'Modifier Fonction Profil: {name}', [
    'name' => $model->ID_FONCT.' '.$model->CODE_PROFIL,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Fonction Profils'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->ID_FONCT, 'url' => ['view', 'ID_FONCT' => $model->ID_FONCT, 'CODE_PROFIL' => $model->CODE_PROFIL]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Modifier');
?>
<div class="fonction-profil-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
