<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\Url;
use kartik\export\ExportMenu;

/* @var $this yii\web\View */
/* @var $searchModel app\models\NiveauSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'A Valider');
//$this->params['breadcrumbs'][] = $this->title;
$gridColumns = [
    ['class' => 'yii\grid\SerialColumn'],

    'NUM_ORDRE:integer',
    [
        'attribute' => 'eNTIFIANT.eNTIFIANT.NOM',
        'label' => 'Demandeur'
    ],
    [
        'attribute' => 'eNTIFIANT.hABILITE.NOM_HABILITE',
        'label' => 'Nom Habilitation'
    ],

    'eTAT.NOM_ETAT',
    'sERVICE.NOM_SERVICE',
    'COMMENTAIRE_NIVEAU:ntext',

    [
        'class' => 'yii\grid\ActionColumn',
        'template' => '{signer}',
        'buttons' => [
            'signer' => function ($url, $model, $key) {
                return Html::a(
                    '<i class="glyphicon glyphicon-adjust"></i>',
                    Url::to(['valid', 'ID' => $model->ID_NIVEAU]),
                    [
                        'id' => 'grid-custom-button',
                        'data-pjax' => true,
                        'title' => 'Valider',
                        'class' => 'button btn btn-default',
                    ]
                );
            }
        ],
    ],
];
?>
<div class="jumbotron jumbotron-royal niveau-index">

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?php try {
        echo ExportMenu::widget([
            'dataProvider' => $dataProvider,
            'columns' => $gridColumns,
            'filename' => "extraction_confirmations",
        ]);
    } catch (Exception $e) {
    }
    ?>

    <?= GridView::widget([
        'tableOptions' => [
            'class' => 'table table-striped',
        ],
        'options' => [
            'class' => 'table-responsive',
        ],
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => $gridColumns,
    ]); ?>
    <?php Pjax::end(); ?>
</div>
