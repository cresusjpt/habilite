<?php

use yii\helpers\Html;
use kartik\form\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Service;
use kartik\select2\Select2;
use app\models\Profil;

/* @var $this yii\web\View */
/* @var $model app\models\Utilisateur */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="card panel-body utilisateur-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php try {
        echo $form->field($model, 'ID_SERVICE')->widget(Select2::class, [
            'data' => ArrayHelper::map(Service::find()->all(), 'ID_SERVICE', 'NOM_SERVICE'),
            'language' => 'fr',
            'options' => ['placeholder' => 'Selectionner votre sevice ...'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]);
    } catch (Exception $e) {
    } ?>

    <?php try {
        echo $form->field($model, 'profil')->widget(Select2::class, [
            'data' => ArrayHelper::map(Profil::find()->all(), 'CODE_PROFIL', 'LIBELLE'),
            'language' => 'fr',
            'options' => ['placeholder' => 'Selectionner le profil...'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]);
    } catch (Exception $e) {
    } ?>

    <?= $form->field($model, 'USERNAME')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'NOM')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'EMAIL')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'FONCTION')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'PASSWORD')->passwordInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ETAT', ['options' => [
        'tag' => 'div',
        'class' => 'form-group label-floating'
    ],
        'template' => "<div class='mdl-checkbox__input'>{input} {label}</div>\n<div>{error}</div>",
    ])->checkbox([
    ]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', $model->isNewRecord ? 'Enrégistrer' : 'Modifier' ), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
