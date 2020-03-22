<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\HabilitationV */
/* @var $modelParam app\models\ValiderV */

$this->title = Yii::t('app', 'Ajouter Validateurs');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Validateurs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="valider-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'modelParam' => $modelParam
    ]) ?>

</div>
