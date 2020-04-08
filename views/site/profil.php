<?php
/**
 * Created by IntelliJ IDEA.
 * User: Simone Sika
 * Date: 19/08/2019
 * Time: 09:38
 */

\app\assets\LoginAsset::register($this);
$profile_dir = \app\controllers\Utils::getPPUrl(true);
?>
<div class="container" style="margin-top: 20px">
    <div class="row">
        <div class="col-lg-4">
            <div class="row">
                <div class="col-lg-12 col-md-6 order-md-1">
                    <div class="card animated fadeInUp animation-delay-7">
                        <div class="ms-hero-bg-primary ms-hero-img-coffee">
                            <h3 class="color-white index-1 text-center no-m pt-4"></h3>
                            <div class="color-medium index-1 text-center np-m"></div>
                            <img src="<?=$profile_dir.'anonymous.jpg'?>" alt="..." class="img-avatar-circle">
                        </div>
                        <div class="card-body pt-4 text-center">
                            <p>Un petit détail ici. Je vais mettre apres un peu de contenu, pour la route. j'imagine que c'est bon ce que je viens d'écrire.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 col-md-12 order-md-3 order-lg-2">
                    <a href="javascript:void(0)" class="btn btn-warning btn-raised btn-block animated fadeInUp animation-delay-12"><i class="zmdi zmdi-edit"></i> Modifier Profil</a>
                </div>
            </div>
        </div>
        <div class="col-lg-8">
            <div class="row">
                <div class="col-sm-4">
                    <div class="card card-info card-body overflow-hidden text-center wow zoomInUp animation-delay-2">
                        <h2 class="counter color-info"><?=$demandeCount?></h2>
                        <i class="fa fa-4x fa-file-text color-info"></i>
                        <p class="mt-2 no-mb lead small-caps color-info">demandes</p>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="card card-success card-body overflow-hidden text-center wow zoomInUp animation-delay-5">
                        <h2 class="counter color-success"><?=$validationCount?></h2>
                        <i class="fa fa-4x fa-briefcase color-success"></i>
                        <p class="mt-2 no-mb lead small-caps color-success">validation</p>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="card card-royal card-body overflow-hidden text-center wow zoomInUp animation-delay-4">
                        <h2 class="counter color-royal">0</h2>
                        <i class="fa fa-4x fa-comments-o color-royal"></i>
                        <p class="mt-2 no-mb lead small-caps color-royal">rejeter</p>
                    </div>
                </div>
            </div>
            <div class="card card-primary animated fadeInUp animation-delay-12">
                <div class="card-header">
                    <h3 class="card-title"><i class="zmdi zmdi-account-circle"></i> Information Général</h3>
                </div>
                <table class="table table-no-border table-striped">
                    <tr>
                        <th><i class="zmdi zmdi-account mr-1 color-success"></i>Nom d'utilisateur</th>
                        <td><?= $model->USERNAME?></td>
                    </tr>
                    <tr>
                        <th><i class="zmdi zmdi-face mr-1 color-warning"></i> Nom complet</th>
                        <td><?= $model->NOM?></td>
                    </tr>
                    <tr>
                        <th><i class="zmdi zmdi-email mr-1 color-danger"></i> Email</th>
                        <td><a href="mailto:<?=$model->EMAIL?>"><?= $model->EMAIL?></a></td>
                    </tr>
                    <tr>
                        <th><i class="zmdi zmdi-link mr-1 color-info"></i> Fonction</th>
                        <td><?=$model->FONCTION?></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>
