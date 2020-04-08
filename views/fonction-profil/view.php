<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\FonctionProfil */

$this->title = $model->ID_FONCT;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Fonction Profils'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="fonction-profil-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Modifier'), ['update', 'ID_FONCT' => $model->ID_FONCT, 'CODE_PROFIL' => $model->CODE_PROFIL], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Supprimer'), ['delete', 'ID_FONCT' => $model->ID_FONCT, 'CODE_PROFIL' => $model->CODE_PROFIL], [
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
            'ID_FONCT',
            'CODE_PROFIL',
        ],
    ]) ?>

</div>
