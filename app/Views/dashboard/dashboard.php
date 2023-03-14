<?= $this->extend('layout/layout') ?>
<?= $this->section('content') ?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
    </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-9">
                <div class="card">
                    <div class="card-body text-center">
                        <div class="row">
                            <div class="col-12">
                                <div id="myChart"></div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-5">
                                <input class="form-control form-control-sm filterTanggal" id="filterTanggal1"
                                    type="text" value="">
                            </div>
                            <div class="col-sm-5">
                                <input class="form-control form-control-sm filterTanggal" id="filterTanggal2"
                                    type="text" value="">
                            </div>
                            <div class="col-2">
                                <button id="filter" type="button" class="btn btn-outline-primary btn-xs"><i
                                        class="fas fa-search"></i></button>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <span>Total Pasien Masuk : </span><span id="pasien-masuk"
                                    class="float-lefty text-danger">0</span>
                            </div>
                            <div class="col-12">
                                <span>Pasien Lama : </span><span id="pasien-lama"
                                    class="float-lefty text-danger">0</span>
                            </div>
                            <div class="col-12">
                                <span>Pasien Baru : </span><span id="pasien-baru"
                                    class="float-lefty text-danger">0</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- /.content -->
<?= $this->endSection() ?>
<?= $this->section('pagecss') ?>
<link rel="stylesheet" href="<?php echo base_url("assets/css/daterangepicker.css");?>">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.css">
<?= $this->endSection() ?>
<?= $this->section('pagejs') ?>
<script src="<?php echo base_url("assets/js/moment.min.js");?>"></script>
<script src="<?php echo base_url("assets/js/daterangepicker.js");?>"></script>
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/series-label.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>
<script src="<?php echo base_url("assets/js/page/dashboard.js");?>"></script>
<?= $this->endSection() ?>