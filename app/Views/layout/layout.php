<!DOCTYPE html>
<?php
use App\Libraries\Mongo;
$mongo = new Mongo();
$data = $mongo->getOne("profil");
?>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $data->nama?></title>
    <link rel="stylesheet" href="<?php echo base_url('assets/css/all.min.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/adminlte.min.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/sweetalert2.min.css'); ?>">
    <style>
    hr.hr-dashed-2 {
        margin-top: 10px;
        margin-bottom: 10px;
        border: 0;
        border-top: 1px dashed #c7c7c7;
    }

    #preloader {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        z-index: 9000;
        background-color: gray;
        opacity: .7;
    }

    #preloader #preloader-inner {
        display: block;
        position: relative;
        left: 50%;
        top: 50%;
        width: 150px;
        height: 150px;
        margin: -75px 0 0 -75px;
        border-radius: 50%;
        border: 3px solid transparent;
        border-top-color: #3498db;
        animation: spin 2s linear infinite
    }

    #preloader #preloader-inner:before {
        content: "";
        position: absolute;
        top: 5px;
        left: 5px;
        right: 5px;
        bottom: 5px;
        border-radius: 50%;
        border: 3px solid transparent;
        border-top-color: #e74c3c;
        animation: spin 3s linear infinite
    }

    #preloader #preloader-inner:after {
        content: "";
        position: absolute;
        top: 15px;
        left: 15px;
        right: 15px;
        bottom: 15px;
        border-radius: 50%;
        border: 3px solid transparent;
        border-top-color: #f9c922;
        animation: spin 1.5s linear infinite
    }

    @keyframes spin {
        0% {
            transform: rotate(0deg)
        }

        to {
            transform: rotate(1turn)
        }
    }

    .text-sm {
        font-size: .775rem !important;
    }

    .text-sm .btn {
        font-size: .775rem !important;
    }

    .form-control-sm {
        height: calc(1.5125rem + 2px);
        font-size: .775rem;
    }

    /* force select2 to match bootstrap form-control-sm */
    .select2,
    .select2-selection__rendered {
        height: calc(1.5125rem + 2px) !important;
    }

    .select2-container .select2-selection--single {
        height: calc(1.5125rem + 2px) !important;
    }

    .select2-selection__arrow {
        height: calc(1.5125rem + 2px) !important;
    }

    select.form-control-sm~.select2-container--default {
        height: calc(1.5125rem + 2px) !important;
        font-size: .775rem !important;
    }

    .select2-container--default .select2-selection--single {
        padding: 0.25rem 0.5rem !important;
    }

    /* force modal header style*/
    .modal-header {
        padding: 0.25rem;
    }
    </style>
    <?= $this->renderSection('pagecss') ?>
</head>

<body class="sidebar-mini sidebar-collapse text-sm">
    <div id="preloader" style="display:none">
        <div id="preloader-inner"></div>
    </div>
    <!-- Site wrapper -->
    <div class="wrapper">
        <!-- Navbar -->
        <input type="hidden" id="base_url" value="<?php echo base_url();?>/">
        <nav class="main-header navbar navbar-expand navbar-danger navbar-light">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
            </ul>
            <!-- Right navbar links -->
            <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
                <li class="nav-item dropdown user-menu">
                    <?php 
                            $session = session();
                        ?>
                    <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                        <img src="<?php echo base_url('assets/img/profil.png');?>"
                            class="user-image img-circle elevation-2" alt="User Image">
                        <span
                            class="d-none d-md-inline"><?php echo $session->get('gelar_depan')." ".ucwords(strtolower($session->get('nama_user')))." ".$session->get('gelar_belakang')." - ".$session->get('poli')?></span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <!-- User image -->
                        <li class="user-header bg-danger">
                            <img src="<?php echo base_url('assets/img/profil.png');?>" class="img-circle elevation-2"
                                alt="User Image">
                                <p><?php echo $session->get('gelar_depan')." ".ucwords(strtolower($session->get('nama_user')))." ".$session->get('gelar_belakang')?></p>
                                <p><?php echo $session->get('kelompok');?></p>
                        </li>
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <a href="<?php echo base_url();?>/login/logout"
                                class="btn btn-outline-success btn-block">Sign out</a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item">
                    <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                        <i class="fas fa-expand-arrows-alt"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
                        <i class="fas fa-th-large"></i>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->
        <!-- Main Sidebar Container -->
        <?= $this->include('layout/sidebar') ?>
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <?= $this->renderSection('content') ?>
        </div>
        <!-- /.content-wrapper -->
        <?= $this->include('layout/footer') ?>
    </div>
    <!-- ./wrapper -->
    <script src="<?php echo base_url('assets/js/jquery.min.js');?>"></script>
    <script src="<?php echo base_url('assets/js/bootstrap.bundle.min.js');?>"></script>
    <script src="<?php echo base_url('assets/js/adminlte.min.js');?>"></script>
    <script src="<?php echo base_url('assets/js/sweetalert2.min.js');?>"></script>
    <?= $this->renderSection('pagejs') ?>
    <audio id="suarabel" src="<?php echo base_url('assets')?>/suara/Airport_Bell.mp3"></audio>
    <audio id="suarabelopen" src="<?php echo base_url('assets')?>/suara/opening.mp3"></audio>
    <audio id="suarabelend" src="<?php echo base_url('assets')?>/suara/ending.mp3"></audio>
    <audio id="suarabelnomorurut" src="<?php echo base_url('assets')?>/suara/antrian-nomor.mp3"></audio>
    <audio id="suarabelsuarabelloket" src="<?php echo base_url('assets')?>/suara/ke-poli.mp3"></audio>
    <audio id="belas" src="<?php echo base_url('assets')?>/suara/belas.mp3"></audio>
    <audio id="sebelas" src="<?php echo base_url('assets')?>/suara/sebelas.mp3"></audio>
    <audio id="puluh" src="<?php echo base_url('assets')?>/suara/puluh.mp3"></audio>
    <audio id="sepuluh" src="<?php echo base_url('assets')?>/suara/sepuluh.mp3"></audio>
    <audio id="ratus" src="<?php echo base_url('assets')?>/suara/ratus.mp3"></audio>
    <audio id="seratus" src="<?php echo base_url('assets')?>/suara/seratus.mp3"></audio>
    <?php for ($i=1; $i < 10; $i++):?>
    <audio id="suarabel<?php echo $i; ?>" src="<?php echo base_url('assets')?>/suara/<?php echo $i; ?>.mp3"></audio>
    <?php endfor;?>
    <audio id="poliumum" src="<?php echo base_url('assets')?>/suara/poliumum.mp3"></audio>
    <audio id="poliumum2" src="<?php echo base_url('assets')?>/suara/poliumum2.mp3"></audio>
</body>

</html>