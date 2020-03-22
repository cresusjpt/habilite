<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\NiveauSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="panel panel-body niveau-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'ID_NIVEAU') ?>

    <?= $form->field($model, 'IDENTIFIANT') ?>

    <?= $form->field($model, 'ID_HABILITE') ?>

    <?= $form->field($model, 'ID_DEMANDE') ?>

    <?= $form->field($model, 'ID_ETAT') ?>

    <?php // echo $form->field($model, 'NUM_ORDRE') ?>

    <?php // echo $form->field($model, 'ID_SERVICE') ?>

    <?php // echo $form->field($model, 'COMMENTAIRE_NIVEAU') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Rechercher'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
