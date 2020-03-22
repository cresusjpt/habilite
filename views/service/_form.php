<?php

use app\models\Utilisateur;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use kartik\form\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Service */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="panel panel-body service-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php try {
        echo $form->field($model, 'NOM_SERVICE')->textInput(['maxlength' => true]);
    } catch (\yii\base\InvalidConfigException $e) {
    } ?>

    <?= $form->field($model, 'ABBR')->textInput(['maxlength' => true]) ?>

    <?php try {
        echo $form->field($model, 'IDENTIFIANT')->widget(Select2::class, [
            'data' => ArrayHelper::map(Utilisateur::find()->all(), 'IDENTIFIANT', 'NOM'),
            'language' => 'fr',
            'options' => ['placeholder' => 'Selectionner responsable ...'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]);
    } catch (\yii\base\InvalidConfigException $e) {
    } catch (Exception $e) {
    } ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', $model->isNewRecord ? 'Enrégistrer' : 'Modifier'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
