<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\SysLog */

$this->title = Yii::t('app', 'Ajouter journal');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Journal Système'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sys-log-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
