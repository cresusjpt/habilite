<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Fonctionnalite */

$this->title = $model->ID_FONCT;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Fonctionnalites'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="fonctionnalite-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Modifier'), ['update', 'id' => $model->ID_FONCT], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Supprimer'), ['delete', 'id' => $model->ID_FONCT], [
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
            //'ID_FONCT',
            'ID_MENU',
            'NAME_FONCT',
            'LIBEL_FONCT',
            'FOCNT_URL:url',
            'CONTROLE_FONCT',
            'NUM_ORDREFONCT',
            'DESCRIPTION_FONCT',
        ],
    ]) ?>

</div>
