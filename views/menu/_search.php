<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\MenuSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="menu-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'ID_MENU') ?>

    <?= $form->field($model, 'MEN_ID_MENU') ?>

    <?= $form->field($model, 'NAME_MENU') ?>

    <?= $form->field($model, 'LIBEL_MENU') ?>

    <?= $form->field($model, 'ICONE_NAME_MENU') ?>

    <?php // echo $form->field($model, 'CONTROLE') ?>

    <?php // echo $form->field($model, 'NUM_ORDREMENU') ?>

    <?php // echo $form->field($model, 'MENU_URL') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Rechercher'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Annuler'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
