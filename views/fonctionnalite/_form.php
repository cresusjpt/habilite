<?php

use yii\helpers\Html;
use kartik\form\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use app\models\Menu;

/* @var $this yii\web\View */
/* @var $model app\models\Fonctionnalite */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="panel panel-body fonctionnalite-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php try {
        echo $form->field($model, 'ID_MENU')->widget(Select2::class, [
            'data' => ArrayHelper::map(Menu::find()->all(), 'ID_MENU', 'LIBEL_MENU'),
            'language' => 'fr',
            'options' => ['placeholder' => 'Selectionner le menu ...'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]);
    } catch (Exception $e) {
    } ?>

    <?= $form->field($model, 'NAME_FONCT')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'LIBEL_FONCT')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'FOCNT_URL')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'CONTROLE_FONCT')->dropDownList([
        'OUI' => 'Oui',
        'NON' => 'Non'
    ], [
        'placeholder' => 'Contrôles sur la fonctionnalité'
    ]) ?>

    <?= $form->field($model, 'NUM_ORDREFONCT')->input('number',['maxlength' => true]) ?>

    <?= $form->field($model, 'DESCRIPTION_FONCT')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', $model->isNewRecord ? 'Enrégistrer' : 'Modifier'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
