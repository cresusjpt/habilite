<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use app\models\ValiderSearch;
use kartik\export\ExportMenu;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ValiderSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Validateur');
$this->params['breadcrumbs'][] = $this->title;
$gridColumns = [

    [
        'class' => 'kartik\grid\ExpandRowColumn',
        'value' => function ($model, $key, $index, $column) {
            return GridView::ROW_COLLAPSED;
        },
        'detail' => function ($model, $key, $index, $column) {
            $searchModele = new ValiderSearch();

            $dataProvider = $searchModele->searchBYHABILITE($model, Yii::$app->request->queryParams);
            return Yii::$app->controller->renderPartial('_validers', [
                'searchModel' => $searchModele,
                'dataProvider' => $dataProvider,
            ]);
        }
    ],
    'hABILITE.NOM_HABILITE',

    ['class' => 'yii\grid\ActionColumn'],
];
?>
<div class="panel panel-body valider-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Ajouter Validateurs'), ['create'], ['class' => 'btn btn-success']) ?>
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
        'export' => [
            'fontAwesome' => true,
        ],
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
