<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\EtatDemande */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="panel panel-body etat-demande-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'NOM_ETAT')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', $model->isNewRecord ? 'Enrégistrer' : 'Modifier'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
