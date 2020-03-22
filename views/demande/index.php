<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use kartik\export\ExportMenu;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\DemandeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Les Demandes');
$this->params['breadcrumbs'][] = $this->title;
$gridColumns = [
    ['class' => 'yii\grid\SerialColumn'],

    [
        'attribute' => 'eNTIFIANT.NOM',
        'label' => 'Demandeur',
    ],
    'hABILITE.NOM_HABILITE',
    'ETAT_DEMANDE',
    [
        'attribute' => 'DATE_DEMANDE',
        'format' => 'raw',
        'value' => function ($model) {
            if (extension_loaded('intl')) {
                return Yii::t('app', Yii::$app->formatter->asDate($model->DATE_DEMANDE), $model->DATE_DEMANDE);
            } else {
                return $model->DATE_DEMANDE;
            }
        },
        'headerOptions' => [
            'class' => 'col-md-2',
        ],
        'filter' => \jino5577\daterangepicker\DateRangePicker::widget([
            'template' => '<div class="input-group"><span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>{input}</div>',
            'model' => $searchModel,
            'locale' => 'fr',
            'options' => [
                'format' => 'YYYY-MM-dd',
            ],
            'attribute' => 'date_demande_range',
            'pluginOptions' => [
                'format' => 'YYYY-MM-dd',
                'autoUpdateInput' => false
            ]
        ]),
    ],
    'DATE_TRAITEMENT:datetime',
    //'SOURCE_DEMANDE',

    ['class' => 'yii\grid\ActionColumn'],
];
?>
<div class="panel panel-body demande-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Faire une Demande'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php try {
        echo ExportMenu::widget([
            'dataProvider' => $dataProvider,
            'columns' => $gridColumns,
            'filename' => "extraction_demandes",
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
