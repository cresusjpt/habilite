<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\SysLog */

$this->title = $model->ID_LOG;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Sys Logs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="sys-log-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->ID_LOG], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', "Voulez vous vraiment supprimer l'élément?"),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'ID_LOG',
            'CODE_ACTION',
            'IDENTIFIANT',
            'DATE_LOG',
            'TABLE_LOG',
            'LIB_LOG',
        ],
    ]) ?>

</div>
