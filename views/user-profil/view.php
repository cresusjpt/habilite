<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\UserProfil */

$this->title = $model->IDENTIFIANT;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'User Profils'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="user-profil-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'IDENTIFIANT' => $model->IDENTIFIANT, 'CODE_PROFIL' => $model->CODE_PROFIL], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'IDENTIFIANT' => $model->IDENTIFIANT, 'CODE_PROFIL' => $model->CODE_PROFIL], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'IDENTIFIANT',
            'CODE_PROFIL',
        ],
    ]) ?>

</div>
