<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\NiveauSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Niveaus');
$this->params['breadcrumbs'][] = $this->title;
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

    ['class' => 'yii\grid\ActionColumn'],
];
?>
<div class="panel panel-body niveau-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Ajouter Niveau'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

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
