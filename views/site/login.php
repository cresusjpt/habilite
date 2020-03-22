<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */

/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Connexion';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="card animated zoomInDown animation-delay-5">
    <div class="card-block">
        <h1 class="color-primary">Connexion</h1>
        <?php $form = ActiveForm::begin(); ?>
        <fieldset>
            <?= $form->field($model, 'username', ['options' => [
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
                                    {error}'

            ])->textInput([
                'id' => 'ms-form-user'
            ]) ?>

            <?= $form->field($model, 'password', ['options' => [
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
                'id' => 'ms-form-pass'
            ]) ?>

            <?= $form->field($model, 'rememberMe', ['options' => [
                'tag' => 'div',
                'class' => 'form-group label-floating'
            ],
                'template' => "<div class='mdl-checkbox__input'>{input} {label}</div>\n<div>{error}</div>",
            ])->checkbox([
            ]) ?>

            <div class="row ">

                <div class="col-md-6">
                    <?= Html::submitButton('Connexion
                            <i class="zmdi zmdi-long-arrow-right no-mr ml-1"></i>', [
                        'class' => 'btn btn-raised btn-primary btn-block'])
                    ?>
                </div>
                <div class="col-md-6">
                    <?= Html::a('<i class="zmdi zmdi-account-add mr-1"></i> Inscription', ['site/register'],
                        [
                            'class' => 'btn btn-primary btn-block'
                        ]);
                    ?>
                </div>
            </div>
        </fieldset>
        <?php ActiveForm::end(); ?>
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

    <?= Html::a('<i class="zmdi zmdi-key"></i> Mot de passe oublié ?', ['site/forgot'], [
        'class' => 'btn btn-white'
    ])
    ?>
</div>

