<?php

use yii\helpers\Html;
use kartik\form\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Menu */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="panel panel-body menu-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'NAME_MENU')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'LIBEL_MENU')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ICONE_NAME_MENU')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'CONTROLE')->dropDownList([
        'OUI' => 'OUI',
        'NON' => 'NON',
    ], ['maxlength' => true]) ?>

    <?= $form->field($model, 'NUM_ORDREMENU')->input('number', ['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', $model->isNewRecord ? 'Enrégistrer' : 'Modifier'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
