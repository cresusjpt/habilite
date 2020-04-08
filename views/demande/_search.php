<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\DemandeSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="demande-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'IDENTIFIANT') ?>

    <?= $form->field($model, 'ID_HABILITE') ?>

    <?= $form->field($model, 'ID_DEMANDE') ?>

    <?= $form->field($model, 'ETAT_DEMANDE') ?>

    <?= $form->field($model, 'DATE_DEMANDE') ?>

    <?= $form->field($model, 'CONTENU_DEMANDE') ?>

    <?php // echo $form->field($model, 'DATE_TRAITEMENT') ?>

    <?php // echo $form->field($model, 'SOURCE_DEMANDE') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Rechercher'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Annuler'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
