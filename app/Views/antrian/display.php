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

    .footer {
        position: fixed;
        left: 0;
        bottom: 0;
        width: 100%;
        background-color: #d47674;
        color: white;
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

<body style="min-height: 466px;">
    <div id="preloader" style="display:none">
        <div id="preloader-inner"></div>
    </div>
    <input type="hidden" id="base_url" value="<?php echo base_url();?>/">
    <div class="row p-2" style="background-color: #d47674;">
        <div class="col-lg-9 col-9">
            <h1><?=$profil->nama?></h1>
            <h4><?=$profil->alamat?></h4>
        </div>
        <div class="col-lg-3 col-3 text-right">
            <span class="h1" id="jam">12:00:03</span><br>
            <span class="h4" id="hasil">Hari,01 Januari 2020</span><br>
        </div>
    </div>
    <div class="pl-3">
        <div class="row">
            <div class="col-md-4 col-4 pt-3" id="nomor">
            </div>
            <div class="col-md-8 col-8">
                <video style="width:100%;max-height:100%" autoplay muted loop controls>
                    <source src="<?php echo base_url("public/display/movie.mp4");?>"
                        type="video/mp4">
                </video>
            </div>
        </div>
        <div class="footer">
            <marquee><span style="font-size: 45px">Klinik sehati melayani dengan sepenuh hati. </span></marquee>
        </div>

    </div>
    <script src="<?php echo base_url('assets/js/jquery.min.js');?>"></script>
    <script src="<?php echo base_url('assets/js/bootstrap.bundle.min.js');?>"></script>
    <script src="<?php echo base_url('assets/js/adminlte.min.js');?>"></script>
    <script src="<?php echo base_url('assets/js/sweetalert2.min.js');?>"></script>
    <script async src="https://www.youtube.com/iframe_api"></script>
    <script src="<?php echo base_url("assets/js/page/antrian.js");?>"></script>
    <?= $this->renderSection('pagejs') ?>
</body>

</html>