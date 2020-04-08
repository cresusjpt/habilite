<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Habilitation */

$this->title = Yii::t('app', 'Modifier Habilitation: {name}', [
    'name' => $model->NOM_HABILITE,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Habilitations'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->ID_HABILITE, 'url' => ['view', 'id' => $model->ID_HABILITE]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Modifier');
?>
<div class="habilitation-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
