<?php

use app\assets\CKEditorAsset;
use app\models\Utilisateur;
use app\models\Habilitation;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use wadeshuler\ckeditor\widgets\CKEditor;

/* @var $this yii\web\View */
/* @var $model app\models\Demande */
/* @var $form yii\widgets\ActiveForm */

CKEditorAsset::register($this);
?>

<div class="panel panel-body demande-form">
    <?php $form = ActiveForm::begin([
        'id' => 'form_demande',
    ]); ?>

    <?php try {
        echo $form->field($model, 'IDENTIFIANT'/*, [
            'readonly'=>true,
        ]*/)->widget(Select2::class, [
            'data' => ArrayHelper::map(Utilisateur::find()->all(), 'IDENTIFIANT', 'NOM'),
            'language' => 'fr',
            'readonly' => true,
            'options' => [
                'placeholder' => 'Selectionner le demandeur ...',
            ],
            'pluginOptions' => [
                'allowClear' => true,
                'readonly' => true,
            ],
        ]);
    } catch (Exception $e) {
    } ?>

    <?= $form->field($model, 'ID_HABILITE')->widget(Select2::class, [
        'data' => ArrayHelper::map(Habilitation::find()->all(), 'ID_HABILITE', 'NOM_HABILITE'),
        'language' => 'fr',
        'options' => ['placeholder' => 'Selectionner l\'habilitation ...', 'id' => 'habilite'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ])->label(false); ?>

    <?= $form->field($model, 'OWNER_SIGN', ['options' => [
        'tag' => 'div',
        'class' => 'form-group label-floating',
    ],
        'template' => "<div class='mdl-checkbox__input'>{input} {label}</div>\n<div>{error}</div>",
    ])->checkbox([
    ]) ?>

    <?php try {
        echo $form->field($model, 'CONTENU_DEMANDE')->widget(CKEditor::class, ['options' => ['rows' => 50, 'id' => 'ckarea']]);
    } catch (Exception $e) {
    } ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', $model->isNewRecord ? 'Enrégistrer' : 'Modifier'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<?php
$jsUrl = \yii\helpers\Url::to(['/']);
$script = <<<JS
$(document).ready(function() {
    let form = $('#form_demande');
});
$('#habilite').change(function() {
    let habilite = $(this).val();
    $.get("$jsUrl"+"demande/get-content",{id:habilite},function(data) {
      let text = CKEDITOR.instances.ckarea.getData();
      CKEDITOR.instances.ckarea.setData(data.CONTENU_MODELE);
    });
});
JS;
$this->registerJs($script);
?>
