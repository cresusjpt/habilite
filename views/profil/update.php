<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Profil */

$this->title = Yii::t('app', 'Update Profil: {name}', [
    'name' => $model->CODE_PROFIL,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Profils'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->CODE_PROFIL, 'url' => ['view', 'id' => $model->CODE_PROFIL]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="profil-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
