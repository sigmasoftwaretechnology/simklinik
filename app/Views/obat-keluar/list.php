<?= $this->extend('layout/layout') ?>
<?= $this->section('content') ?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <h6>Obat Keluar</h6>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?php echo base_url();?>/farmasi">Farmasi</a></li>
                    <li class="breadcrumb-item active">Obat</li>
                </ol>
            </div>
        </div>
    </div>
</section>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body p-2">
                        <div class="row">
                            <div class="col-sm-1">
                                <input class="form-control form-control-sm filterTanggal" id="filterTanggal1"
                                    type="text" value="<?=date('d-m-Y')?>">
                            </div>
                            <div class="col-sm-1">
                                <input class="form-control form-control-sm filterTanggal" id="filterTanggal2"
                                    type="text" value="<?=date('d-m-Y')?>">
                            </div>
                            <div class="col-3">
								<button id="filter" type="button" class="btn btn-danger btn-xs"><img src="<?php echo base_url(); ?>/assets/img/icon/search.png"> Filter</button>
                                <button id="export" type="button" class="btn btn-danger btn-xs"><img
                                        src="<?php echo base_url(); ?>/assets/img/icon/export.png"> Export</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12" id="content">
			<?php echo view('obat-keluar/tabel'); ?>
            </div>
        </div>
    </div>
</section>
<!-- /.content -->
<?= $this->endSection() ?>
<?= $this->section('pagecss') ?>
<link rel="stylesheet" href="<?php echo base_url("assets/css/daterangepicker.css");?>">
<?= $this->endSection() ?>
<?= $this->section('pagejs') ?>
<script src="<?php echo base_url("assets/js/moment.min.js");?>"></script>
<script src="<?php echo base_url("assets/js/daterangepicker.js");?>"></script>
<script src="<?php echo base_url("assets/js/jquery.mask.min.js");?>"></script>
<script src="<?php echo base_url("assets/js/page/obat-keluar.js");?>"></script>
<?= $this->endSection() ?>