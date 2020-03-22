<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\UserProfil */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-profil-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'IDENTIFIANT')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'CODE_PROFIL')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
