<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Niveau */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="panel panel-body niveau-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'IDENTIFIANT')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ID_HABILITE')->textInput() ?>

    <?= $form->field($model, 'ID_DEMANDE')->textInput() ?>

    <?= $form->field($model, 'ID_ETAT')->textInput() ?>

    <?= $form->field($model, 'NUM_ORDRE')->textInput() ?>

    <?= $form->field($model, 'ID_SERVICE')->textInput() ?>

    <?= $form->field($model, 'COMMENTAIRE_NIVEAU')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
