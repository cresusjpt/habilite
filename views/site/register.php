<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */

/* @var $model app\models\LoginForm */

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use kartik\select2\Select2;
use app\models\Service;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="card animated zoomInDown animation-delay-5">
    <div class="card-block">
        <h1 class="color-primary">Inscription</h1>
        <?php $form = ActiveForm::begin(); ?>
        <fieldset>
            <?= $form->field($model, 'NOM', ['options' => [
                'tag' => 'div',
                'class' => 'form-group label-floating'
            ],
                'template' => '
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="zmdi zmdi-account"></i>
                                        </span>
                                        {label}
                                        {input}
                                    </div>
                                    <label>{error}</label>'

            ])->textInput([
                'id' => 'ms-form-user-name-r'
            ]) ?>

            <?= $form->field($model, 'USERNAME', ['options' => [
                'tag' => 'div',
                'class' => 'form-group label-floating'
            ],
                'template' => '
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="zmdi zmdi-account"></i>
                                        </span>
                                        {label}
                                        {input}
                                    </div>
                                    <label>{error}</label>'

            ])->textInput([
                'id' => 'ms-form-user-r'
            ]) ?>

            <?= $form->field($model, 'EMAIL', ['options' => [
                'tag' => 'div',
                'class' => 'form-group label-floating'
            ],
                'template' => '
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="zmdi zmdi-email"></i>
                                        </span>
                                        {label}
                                        {input}
                                    </div>
                                    <label>{error}</label>'

            ])->textInput([
                'id' => 'ms-form-email-r'
            ]) ?>

            <?= $form->field($model, 'PASSWORD', ['options' => [
                'tag' => 'div',
                'class' => 'form-group label-floating'
            ],
                'template' => '
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="zmdi zmdi-lock"></i>
                                        </span>
                                        {label}
                                        {input}
                                    </div>
                                    <label>{error}</label>'

            ])->passwordInput([
                'id' => 'ms-form-pass-r'
            ]) ?>

            <?= $form->field($model, 'rawpassword', ['options' => [
                'tag' => 'div',
                'class' => 'form-group label-floating'
            ],
                'template' => '
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="zmdi zmdi-account"></i>
                                        </span>
                                        {label}
                                        {input}
                                    </div>
                                    <label>{error}</label>'

            ])->passwordInput([
                'id' => 'ms-form-pass-retype'
            ]) ?>

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

            <?= Html::submitButton('S\'enrégistrer', [
                'class' => 'btn btn-raised btn-block btn-primary'])
            ?>
        </fieldset>
        <?php $form::end(); ?>
        <div class="text-center">
            <h3 class="color-dark">HABILITE</h3>
        </div>
    </div>
</div>
<div class="text-center animated fadeInUp animation-delay-7">
    <?= Html::a('<i class="zmdi zmdi-home"></i> Acceuil', ['site/index'], [
        'class' => 'btn btn-white'
    ])
    ?>

    <?= Html::a('<i class="zmdi zmdi-account"></i> Connexion', ['site/login'], [
        'class' => 'btn btn-white'
    ])
    ?>
</div>
