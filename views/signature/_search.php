<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\SignatureSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="signature-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'ID_SIGNATURE') ?>

    <?= $form->field($model, 'IDENTIFIANT') ?>

    <?= $form->field($model, 'SOURCE_SIGNATURE') ?>

    <?= $form->field($model, 'ACTIF') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Rechercher'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Annuler'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
