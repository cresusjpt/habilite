<?php

use yii\helpers\Html;
use kartik\form\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Utilisateur;
use app\models\Demande;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model app\models\Notification */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="card panel-body notification-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php try {
        echo $form->field($model, 'IDENTIFIANT')->widget(Select2::class, [
            'data' => ArrayHelper::map(Utilisateur::find()->all(), 'IDENTIFIANT', 'NOM'),
            'language' => 'fr',
            'options' => ['placeholder' => "Selectionner l'utilisateur ..."],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ])->label(false);
    } catch (Exception $e) {
    } ?>


    <?php try {
        echo $form->field($model, 'ID_DEMANDE')->widget(Select2::class, [
            'data' => ArrayHelper::map(Demande::find()->all(), 'ID_DEMANDE', 'detaildemande'),
            'language' => 'fr',
            'options' => ['placeholder' => "Selectionner la demande concernée ..."],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ])->label(false);
    } catch (\yii\base\InvalidConfigException $e) {
    } ?>

    <?php try {
        echo $form->field($model, 'MESSAGE')->textarea(['rows' => 6]);
    } catch (\yii\base\InvalidConfigException $e) {
    } ?>

    <?= $form->field($model, 'ACTIF', ['options' => [
        'tag' => 'div',
        'class' => 'form-group label-floating'
    ],
        'template' => "<div class='mdl-checkbox__input'>{input} {label}</div>\n<div>{error}</div>",
    ])->checkbox([
    ]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', $model->isNewRecord ? 'Enrégistrer' : 'Modifier'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
