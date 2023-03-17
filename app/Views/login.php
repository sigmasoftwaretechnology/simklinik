<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?=$profil->nama?></title>
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/all.min.css');?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/adminlte.min.css');?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/sweetalert2.min.css');?>">
    <style>
    .form-control-xs {
        height: calc(1.5em + .375rem + 2px);
        padding: .125rem .25rem !important;
        font-size: .875rem !important;
        line-height: 1.5;
        border-radius: .2rem;
    }

    input.disabled-input {
        pointer-events: none;
        background-color: #e9ecef;
        opacity: 1;
    }

    textarea.form-control-xs {
        height: auto;
    }

    .btn-xxs {
        height: calc(1.5em + .375rem + 2px) !important;
        padding: .125rem .25rem !important;
        line-height: 1.5;
        border-radius: .2rem;
    }

    textarea.form-control-xs {
        height: auto;
    }

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
    </style>
    <?= $this->renderSection('pagecss') ?>
</head>

<body class="login-page" style="min-height: 466px;">
    <div id="preloader" style="display:none">
        <div id="preloader-inner"></div>
    </div>
    <input type="hidden" id="base_url" value="<?php echo base_url();?>/">

    <div class="login-box">
        <!-- /.login-logo -->
        <div class="card card-outline card-danger">
            <div class="card-header text-center">
                <p class="h1"><?=$profil->nama?></p>
            </div>
            <div class="card-body">
                <?php if (session()->getFlashdata('msg')):?>
                    <div class="alert alert-danger"><?= session()->getFlashdata('msg') ?></div>
                <?php endif;?>
                <form action="<?php echo base_url();?>/login/auth" method="post">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control form-control-xs" placeholder="NIK" name="nik">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control form-control-xs" placeholder="Password"
                            name="password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
						<select class="form-control form-control-xs" name="poli">
						<option value="">Semua Poli</option>
						<?php foreach($poli as $pl):?>
						<option value="<?=$pl->nama?>"><?=$pl->nama?></option>
						<?php endforeach;?>
						</select>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <button type="submit" class="btn btn-outline-primary btn-xs btn-block">Sign In</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>

            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <script src="<?php echo base_url('assets/js/jquery.min.js');?>"></script>
    <script src="<?php echo base_url('assets/js/bootstrap.bundle.min.js');?>"></script>
    <script src="<?php echo base_url('assets/js/adminlte.min.js');?>"></script>
    <script src="<?php echo base_url('assets/js/sweetalert2.min.js');?>"></script>
    <?= $this->renderSection('pagejs') ?>
</body>
</html>