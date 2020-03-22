<?php

use kidzen\dynamicform\DynamicFormWidget;
use yii\helpers\Html;
use kartik\form\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Service;
use app\models\Habilitation;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model app\models\HabilitationV */
/* @var $modelParam app\models\ValiderV */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="valider-form">

    <?php $form = ActiveForm::begin(['id' => 'dynamic-form']); ?>

    <?= $form->field($model, 'ID_HABILITE')->widget(Select2::class, [
        'data' => ArrayHelper::map(Habilitation::find()->all(), 'ID_HABILITE', 'NOM_HABILITE'),
        'language' => 'fr',
        'options' => ['placeholder' => 'Selectionner l\'habilitation ...'],
        'pluginOptions' => [
            'allowClear' => true,
        ],
    ])->label(false) ?>

    <div class="panel-body row">
        <div class="panel panel-default">
            <div class="panel-heading"><h4><i class="glyphicon glyphicon-certificate"></i>Les validateurs</h4></div>
            <div class="panel-body">
                <?php DynamicFormWidget::begin([
                    'widgetContainer' => 'dynamicform_wrapper', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
                    'widgetBody' => '.container-items', // required: css class selector
                    'widgetItem' => '.item', // required: css class
                    'limit' => 5, // the maximum times, an element can be cloned (default 999)
                    'min' => 1, // 0 or 1 (default 1)
                    'insertButton' => '.add-item', // css class
                    'deleteButton' => '.remove-item', // css class
                    'model' => $modelParam[0],
                    'formId' => 'dynamic-form',
                    'formFields' => [
                        'ID_HABILITE',
                        'ID_SERVICE',
                        'NUM_ORDRE',
                    ],
                ]); ?>

                <div class="container-items"><!-- widgetContainer -->
                    <?php foreach ($modelParam as $i => $oneParam): ?>
                        <div class="item panel panel-default"><!-- widgetBody -->
                            <div class="panel-heading">
                                <h3 class="panel-title pull-left">Validateur</h3>
                                <div class="pull-right">
                                    <button type="button" class="add-item btn btn-success btn-xs"><i
                                                class="glyphicon glyphicon-plus"></i></button>
                                    <button type="button" class="remove-item btn btn-danger btn-xs"><i
                                                class="glyphicon glyphicon-minus"></i></button>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div class="panel-body">
                                <?php
                                // necessary for update action.
                                if (!$oneParam->isNewRecord) {
                                    echo Html::activeHiddenInput($oneParam, "[{$i}]ID_HABILITE");
                                }
                                ?>
                                <div class="col-md-6">
                                    <?php try {
                                        echo $form->field($oneParam, "[{$i}]ID_SERVICE")->widget(Select2::class, [
                                            'data' => ArrayHelper::map(Service::find()->all(), 'ID_SERVICE', 'NOM_SERVICE'),
                                            'language' => 'fr',
                                            'options' => ['placeholder' => 'Selectionner votre sevice ...'],
                                            'pluginOptions' => [
                                                'allowClear' => true
                                            ],
                                        ])->label(false);
                                    } catch (Exception $e) {
                                    } ?>
                                </div>

                                <div class="col-md-6">
                                    <?php try {
                                        echo $form->field($oneParam, "[{$i}]NUM_ORDRE")->input('number',
                                            ['prompt' => 'Numero d\'ordre de signature du service', 'min' => 0, 'step' => 1]);
                                    } catch (\yii\base\InvalidConfigException $e) {
                                    }
                                    ?>
                                </div>

                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
                <?php DynamicFormWidget::end(); ?>
            </div>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', $model->isNewRecord ? 'Enrégister' : 'Modifier'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
