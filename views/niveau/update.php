<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Niveau */

$this->title = Yii::t('app', 'Modifier Niveau: {name}', [
    'name' => $model->ID_NIVEAU,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Niveaus'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->ID_NIVEAU, 'url' => ['view', 'id' => $model->ID_NIVEAU]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Modifier');
?>
<div class="niveau-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
