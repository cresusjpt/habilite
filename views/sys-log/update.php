<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\SysLog */

$this->title = Yii::t('app', 'Modifier Journal Système: {name}', [
    'name' => $model->ID_LOG,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Journal Système'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->ID_LOG, 'url' => ['view', 'id' => $model->ID_LOG]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Modifier');
?>
<div class="sys-log-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
