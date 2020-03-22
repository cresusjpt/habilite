<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\UtilisateurSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="utilisateur-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'IDENTIFIANT') ?>

    <?= $form->field($model, 'ID_SERVICE') ?>

    <?= $form->field($model, 'EMAIL') ?>

    <?= $form->field($model, 'USERNAME') ?>

    <?= $form->field($model, 'PASSWORD') ?>

    <?php // echo $form->field($model, 'AUTH_KEY') ?>

    <?php // echo $form->field($model, 'ACCESS_TOKEN') ?>

    <?php // echo $form->field($model, 'ETAT') ?>

    <?php // echo $form->field($model, 'DM_MODIFICATION') ?>

    <?php // echo $form->field($model, 'PHOTO') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Rechercher'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Annuler'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
