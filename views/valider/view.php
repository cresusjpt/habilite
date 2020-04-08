<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $models app\models\Valider */

$model = $models[0];


$this->title = $model->hABILITE->NOM_HABILITE;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Validateurs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="valider-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Modifier'), ['update', 'ID_SERVICE' => $model->ID_SERVICE, 'ID_HABILITE' => $model->ID_HABILITE], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Supprimer'), ['delete', 'ID_SERVICE' => $model->ID_SERVICE, 'ID_HABILITE' => $model->ID_HABILITE], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', "Voulez vous vraiment supprimer l'élément?"),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?php
    foreach ($models as $oneModel) {
        ?>
        <?= DetailView::widget([
            'model' => $oneModel,
            'attributes' => [
                'sERVICE.NOM_SERVICE',
                'hABILITE.NOM_HABILITE',
                'NUM_ORDRE',
            ],
        ]) ?>
        <?php
    }
    ?>
</div>
