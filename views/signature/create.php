<?php


use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Signature */

$this->title = Yii::t('app', 'Ajouter une Signature');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Signatures'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="signature-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
