<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\FonctionnaliteSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="fonctionnalite-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'ID_FONCT') ?>

    <?= $form->field($model, 'ID_MENU') ?>

    <?= $form->field($model, 'NAME_FONCT') ?>

    <?= $form->field($model, 'LIBEL_FONCT') ?>

    <?= $form->field($model, 'FOCNT_URL') ?>

    <?php // echo $form->field($model, 'CONTROLE_FONCT') ?>

    <?php // echo $form->field($model, 'NUM_ORDREFONCT') ?>

    <?php // echo $form->field($model, 'DESCRIPTION_FONCT') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Rechercher'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Annuler'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
