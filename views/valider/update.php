<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\HabilitationV */
/* @var $modelParam app\models\ValiderV */

$this->title = Yii::t('app', 'Modifier Valider: {name}', [
    'name' => $model->NOM_HABILITE,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Validateurs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $modelParam[0]->ID_SERVICE, 'url' => ['view', 'ID_SERVICE' => $modelParam[0]->ID_SERVICE, 'ID_HABILITE' => $model->ID_HABILITE]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Modifier');
?>
<div class="valider-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'modelParam' => $modelParam,
    ]) ?>

</div>
