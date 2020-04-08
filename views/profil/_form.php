<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Profil */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="profil-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'CODE_PROFIL')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'LIBELLE')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', $model->isNewRecord ? 'Enrégistrer' : 'Modifier'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
