<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Service */

$this->title = Yii::t('app', 'Modifier Service: {name}', [
    'name' => $model->ID_SERVICE,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Services'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->ID_SERVICE, 'url' => ['view', 'id' => $model->ID_SERVICE]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Modifier');
?>
<div class="service-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
