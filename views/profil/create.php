<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Profil */

$this->title = Yii::t('app', 'Ajouter Profil');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Profils'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="profil-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
