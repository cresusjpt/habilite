<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ValiderSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Services validateurs');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="validers-index">

    <?php Pjax::begin()?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'sERVICE.NOM_SERVICE',
            'sERVICE.eNTIFIANT.NOM',
            'NUM_ORDRE:integer',
        ],
    ]); ?>
    <?php Pjax::end()?>
</div>
