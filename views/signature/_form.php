<?php

use yii\helpers\Html;
use kartik\form\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Utilisateur;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model app\models\Signature */
/* @var $form yii\widgets\ActiveForm */

\app\assets\JSignatureAsset::register($this);
?>

<div class="panel panel-body signature-form">

    <?php $form = ActiveForm::begin([
        'id' => 'form_signature',
    ]); ?>

    <?php try {
        echo $form->field($model, 'IDENTIFIANT')->widget(Select2::class, [
            'data' => ArrayHelper::map(Utilisateur::find()->all(), 'IDENTIFIANT', 'NOM'),
            'language' => 'fr',
            'options' => ['placeholder' => 'Selectionner le nom ...'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ])->label(false);
    } catch (Exception $e) {
    } ?>

    <?= $form->field($model, 'ACTIF', ['options' => [
        'tag' => 'div',
        'class' => 'form-group label-floating',
    ],
        'template' => "<div class='mdl-checkbox__input'>{input} {label}</div>\n<div>{error}</div>",
    ])->checkbox([
    ]) ?>

    <?php try {
        echo $form->field($model, 'CONTENU_SIGNATURE', ['options' => [
            'style' => 'display: none',
            'id' => '_signaturr'
        ],

        ])->textarea([
            'id' => 'signature_content',
        ]);
    } catch (\yii\base\InvalidConfigException $e) {
    } ?>

    <div id="content">
        <div id="signatureparent">
            <div>Signer ici !</div>
            <div id="signature"></div>
        </div>
    </div>
    <div id="scrollgrabber"></div>

    <? /*= \jberall\signaturedraw\SignatureDraw::widget(); */ ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', $model->isNewRecord ? 'Enrégistrer' : 'Modifier'), ['class' => 'btn btn-success']) ?>
        <?= Html::button(Yii::t('app', 'Effacer Signature'), [
            'id' => 'sign_reset',
        ]) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<?php
$model->ACTIF = 1;
$script = <<<JS
$(document).ready(new function() {
    let sigdiv = $("#signature");
    let signature_content = $('#signature_content');
    sigdiv.jSignature();
    
    if (signature_content.val().trim().length > 0 ){
        let tester =  signature_content.val();
        let newval = tester.split(',');
        sigdiv.jSignature("setData", "data:" + newval) 
    }
    
    $('#sign_reset').click(function() {
      sigdiv.jSignature("reset");
      $('#signature_content').val('');
    });
    
    $('#form_signature').submit(function() {
      let datapair = sigdiv.jSignature("getData","base30");
      let isSignatureProvided=datapair[1].length>10?true:false;
      if (!isSignatureProvided){
          alert('Vous devez ajouter une signature');
          return false;
      }else {
          signature_content.val(datapair);
          //$('#_signaturr').show();
          sigdiv.jSignature("reset");
          let tester =  signature_content.val();
          let newval = tester.split(',');
          sigdiv.jSignature("setData", "data:" + newval) 
          return true;
      }
    });
});
JS;
$css = <<< CSS
/*div {
		margin-top:1em;
		margin-bottom:1em;
	}*/
	input {
		padding: .5em;
		margin: .5em;
	}
	select {
		padding: .5em;
		margin: .5em;
	}
	
/*	#signatureparent {
		color:darkblue;
		background-color:darkgrey;
		!*max-width:600px;*!
		padding:20px;
	}*/
	
	/*This is the div within which the signature canvas is fitted*/
	#signature {
		border: 2px dotted black;
		/*background-color:lightgrey;*/
	}

	/* Drawing the 'gripper' for touch-enabled devices */ 
	html.touch #content {
		float:left;
		width:92%;
	}
	html.touch #scrollgrabber {
		float:right;
		width:4%;
		margin-right:2%;
		background-image:url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAAFCAAAAACh79lDAAAAAXNSR0IArs4c6QAAABJJREFUCB1jmMmQxjCT4T/DfwAPLgOXlrt3IwAAAABJRU5ErkJggg==)
	}
	html.borderradius #scrollgrabber {
		border-radius: 1em;
	}
CSS;
$this->registerCss($css);
$this->registerJs($script);
?>
