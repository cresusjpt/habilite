<?php

use yii\helpers\Html;
use kartik\form\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use app\models\Fonctionnalite;

/* @var $this yii\web\View */
/* @var $model app\models\FonctionProfil */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="panel panel-body fonction-profil-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'ID_FONCT')->widget(Select2::class, [
        'data' => ArrayHelper::map(Fonctionnalite::find()->all(), 'ID_FONCT', 'LIBEL_FONCT'),
        'language' => 'fr',
        'options' => ['placeholder' => 'Selectionner fonctionnalités ...'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ])->label(false) ?>

    <?= $form->field($model, 'CODE_PROFIL')->widget(Select2::class, [
        'data' => ArrayHelper::map(Fonctionnalite::find()->all(), 'CODE_PROFIL', 'LIBELLE'),
        'language' => 'fr',
        'options' => ['placeholder' => 'Selectionner profil ...'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ])->label(false) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', $model->isNewRecord ? 'Enrégistrer' : 'Modifier'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
