<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use kartik\export\ExportMenu;

/* @var $this yii\web\View */
/* @var $searchModel app\models\DemandeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Mes Demandes');
//$this->params['breadcrumbs'][] = $this->title;
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
            /*'template' => '<div class="input-group"><span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>{input}</div>',*/
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
    [
        'class' => 'yii\grid\ActionColumn',
        'template' => '{view}{update}',
        'buttons' => [
            'view' => function ($url, $model, $key) {
                $url = \yii\helpers\Url::toRoute(['demande/view', 'IDENTIFIANT' => $model->IDENTIFIANT, 'ID_HABILITE' => $model->ID_HABILITE, 'ID_DEMANDE' => $model->ID_DEMANDE]);
                return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', $url, [
                    'title' => Yii::t('app', 'Consulter'),
                ]);
            },
            'update' => function ($url, $model, $key) {
                $url = \yii\helpers\Url::toRoute(['demande/update', 'IDENTIFIANT' => $model->IDENTIFIANT, 'ID_HABILITE' => $model->ID_HABILITE, 'ID_DEMANDE' => $model->ID_DEMANDE]);
                return Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url, [
                    'title' => Yii::t('app', 'Modifier'),
                ]);
            },
        ],
    ],
];
?>
<div class="jumbotron jumbotron-royal panel-body demande-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Faire une Demande'), ['demande/my-create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php try {
        echo ExportMenu::widget([
            'dataProvider' => $dataProvider,
            'columns' => $gridColumns,
            'filename' => "extraction_mes_demandes",
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

