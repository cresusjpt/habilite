<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Demande */

$this->title = Yii::t('app', 'Effectuer Demande');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Demandes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="demande-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
