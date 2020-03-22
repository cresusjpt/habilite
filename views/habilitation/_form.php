<?php

use yii\helpers\Html;
use kartik\form\ActiveForm;
use wadeshuler\ckeditor\widgets\CKEditor;

/* @var $this yii\web\View */
/* @var $model app\models\Habilitation */
/* @var $form yii\widgets\ActiveForm */
\app\assets\CKEditorAsset::register($this);
?>

<div class="panel panel-body habilitation-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'NOM_HABILITE')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'SERVICE_RESP', ['options' => [
        'tag' => 'div',
        'class' => 'form-group label-floating',
    ],
        'template' => "<div class='mdl-checkbox__input'>{input} {label}</div>\n<div>{error}</div>",
    ])->checkbox([
    ]) ?>

    <?= $form->field($model, 'CONTENU_MODELE')->widget(CKEditor::class, ['options' => ['rows' => 50],]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', $model->isNewRecord ? 'Enrégistrer' : 'Modifier'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
