<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Signature */

$this->title = $model->eNTIFIANT->NOM.' '.$model->ID_SIGNATURE;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Signatures'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$image = \app\controllers\Utils::base30_to_jpeg($model->CONTENU_SIGNATURE);
$image = \app\controllers\Utils::getTmpUrl(true).$image;
\yii\web\YiiAsset::register($this);
?>
<div class="signature-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Modifier'), ['update', 'id' => $model->ID_SIGNATURE], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Supprimer'), ['delete', 'id' => $model->ID_SIGNATURE], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Voulez vous vraiment supprimer l\'élément?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'eNTIFIANT.NOM',
            'SOURCE_SIGNATURE',
            'ACTIF:boolean',
        ],
    ]) ?>

    <?=
    Html::img($image);
    ?>

</div>
