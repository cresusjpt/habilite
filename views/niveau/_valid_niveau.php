<?php
/**
 * Created by IntelliJ IDEA.
 * User: Jeanpaul Tossoi
 * Date: 16/08/2019
 * Time: 11:53
 */

use kartik\form\ActiveForm;
use app\models\EtatDemande;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use app\assets\NiveauValidAsset;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Niveau */
/* @var $demande app\models\Demande */
/* @var $signature app\models\Signature */
/* @var $signataire app\models\Utilisateur */
/* @var $image */
/* @var $form yii\widgets\ActiveForm */

NiveauValidAsset::register($this);
$this->title = "Validation des fiches";
?>

<div class="card panel-body niveau-form" style="margin-top: 70px">

    <?php $form = ActiveForm::begin([
        'id' => 'form_valid',
    ]); ?>

    <?= $form->field($model, 'ID_ETAT')->widget(Select2::class, [
        'data' => ArrayHelper::map(EtatDemande::find()->all(), 'ID_ETAT', 'NOM_ETAT'),
        'language' => 'fr',
        'options' => ['placeholder' => 'Selectionner votre sevice ...'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ])->label('Etat') ?>

    <?= $form->field($model, 'COMMENTAIRE_NIVEAU')->textarea(['maxlength' => true]) ?>

    <div class="form form-group">
        <?= Html::submitButton(Yii::t('app', $model->isNewRecord ? 'Enrégistrer' : 'Valider'), ['class' => 'btn btn-success']) ?>
        <?php ActiveForm::end(); ?>
    </div>
</div>

<div class="toolbar">
    <label id="labelName" style="display: none">Jeanpaul Tossou</label>
    <img class='imgSrc' id="signImg" style="display: none"
         src="data:image/png;base64,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"/>
    <div class="tool">
        <button class="color-tool active" style="background-color: #212121;"></button>
        <button class="color-tool" style="background-color: red;"></button>
        <button class="color-tool" style="background-color: blue;"></button>
    </div>
    <div class="tool" style="display: none;">
        <button class="btn btn-primary btn-sm" id="savebt" onclick="Niveau.savePDF()"><i class="fa fa-save"></i>
            Enrégistrer
        </button>
    </div>
    <div class="tool">
        <button class="tool-button"><i class="fa fa-font" title="Nom et Date" onclick="Niveau.enableAddText(event)"></i>
        </button>
    </div>
    <div class="tool">
        <!--Niveau.enableImage(event)-->
        <button class="tool-button active">
            <i class="fa fa-image" title="Ajouter ma signature" onclick="Niveau.authenticateUser(event)"></i>
        </button>
    </div>
    <div class="tool">
        <button class="btn btn-danger btn-sm" onclick="Niveau.deleteSelectedObject(event)">
            <i class="fa fa-trash"></i>
        </button>
    </div>
    <div class="tool">
        <button class="btn btn-danger btn-sm" onclick="Niveau.clearPage()"><!--<i class="fa fa-close"></i>-->Nettoyer la
            page
        </button>
    </div>
</div>

<div id="pdf-container"></div>

<div class="modal fade" id="dataModal" tabindex="-1" role="dialog" aria-labelledby="dataModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="dataModalLabel">PDF annotation data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
				<pre class="prettyprint lang-json linenums">
				</pre>
            </div>
        </div>
    </div>
</div>
<?php
$file = \app\controllers\Utils::getDemandeUrl(true) . $demande->SOURCE_DEMANDE;
$sign = \app\controllers\Utils::getTmpUrl(true) . $image;
$hurl = \yii\helpers\Url::base(true);

$pdfjsf = \yii\helpers\Url::base().'/pdfjsf/';
$this->registerJsFile('https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.4/jquery.min.js');
$this->registerJsFile($pdfjsf.'pdfannotate.js?'.(time()+1));
$this->registerJsFile($pdfjsf.'script.js?'.(time()+1));

$script = <<< JS
const json_object = {
    file : "$file",
    image : "$sign",
    name : "$signataire->NOM",
    demande : "$demande->ID_DEMANDE",
    identifiant : "$demande->IDENTIFIANT",
    hurl : "$hurl",
 };
Niveau.init(json_object);
JS;
$this->registerJs($script);
?>
