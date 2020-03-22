<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\SysParam */

$this->title = Yii::t('app', 'Modifier Paramètre Système: {name}', [
    'name' => $model->PARAM_CODE,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Paramètres Système'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->PARAM_CODE, 'url' => ['view', 'id' => $model->PARAM_CODE]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Modifier');
?>
<div class="sys-param-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
