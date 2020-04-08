<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\UserProfil */

$this->title = Yii::t('app', 'Update User Profil: {name}', [
    'name' => $model->IDENTIFIANT,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'User Profils'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->IDENTIFIANT, 'url' => ['view', 'IDENTIFIANT' => $model->IDENTIFIANT, 'CODE_PROFIL' => $model->CODE_PROFIL]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="user-profil-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
