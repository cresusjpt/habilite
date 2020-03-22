<?php
/**
 * Created by IntelliJ IDEA.
 * User: Jeanpaul Tossou
 * Date: 09/06/2019
 * Time: 15:26
 */
/* @var $this yii\web\View */

$this->title = 'EXPLORATEURS DES DEMANDES | BANQUE ATLANTIQUE';
$this->params['titleMain'] = "Mes Documents";
?>
<div class="embed-responsive embed-responsive-4by3"><!-- embed-responsive-16by9-->
    <iframe class="embed-responsive-item" src="<?=\yii\helpers\Url::base(true).'/explorer'?>"></iframe>
</div>
