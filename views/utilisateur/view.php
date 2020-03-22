<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Utilisateur */

$this->title = $model->NOM;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Utilisateurs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="card panel-body utilisateur-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Modfier'), ['update', 'id' => $model->IDENTIFIANT], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Supprimer'), ['delete', 'id' => $model->IDENTIFIANT], [
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
            'sERVICE.NOM_SERVICE',
            'EMAIL:email',
            'USERNAME',
            [
                'attribute' => 'ETAT',
                'label' => 'Actif',
                'format' => 'boolean',
            ],
            'DM_MODIFICATION:datetime',
            'FONCTION',
            'cODEPROFILs.LIBELLE'
        ],
    ]) ?>

</div>
