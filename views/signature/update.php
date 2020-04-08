<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Signature */

$this->title = Yii::t('app', 'Modifier Signature: {name}', [
    'name' => $model->eNTIFIANT->NOM,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Signatures'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->ID_SIGNATURE, 'url' => ['view', 'id' => $model->ID_SIGNATURE]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Modifier');
?>
<div class="signature-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
