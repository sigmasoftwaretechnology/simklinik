<?= $this->extend('layout/layout') ?>
<?= $this->section('content') ?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h6>Setting</h6>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2">
                <a href="<?=base_url()?>/setting/buka-erm">
                    <div class="card">
                        <div class="card-body text-center p-3">
                            <img src="<?php echo base_url('assets/img/pasien.png');?>">
                            <small class="mb-0 d-block">Buka ERM</small>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-2">
                <a href="<?=base_url()?>/setting/informasi">
                    <div class="card">
                        <div class="card-body text-center p-3">
                            <img src="<?php echo base_url('assets/img/klinik.png');?>">
                            <small class="mb-0 d-block">Informasi</small>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-2">
                <a href="<?=base_url()?>/setting/poli">
                    <div class="card">
                        <div class="card-body text-center p-3">
                            <img src="<?php echo base_url('assets/img/poli.png');?>">
                            <small class="mb-0 d-block">Poli</small>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-2">
                <a href="<?=base_url()?>/setting/unit">
                    <div class="card">
                        <div class="card-body text-center p-3">
                            <img src="<?php echo base_url('assets/img/sdm.png');?>">
                            <small class="mb-0 d-block">Unit Kerja</small>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-2">
                <a href="<?=base_url()?>/setting/pengguna">
                    <div class="card">
                        <div class="card-body text-center p-3">
                            <img src="<?php echo base_url('assets/img/tambah-user.png');?>">
                            <small class="mb-0 d-block">Pengguna</small>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-2">
                <a href="<?=base_url()?>/setting/antrian">
                    <div class="card">
                        <div class="card-body text-center p-3">
                            <img src="<?php echo base_url('assets/img/voting.png');?>">
                            <small class="mb-0 d-block">Antrian</small>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
</section>
<!-- /.content -->
<?= $this->endSection() ?>
<?= $this->section('pagecss') ?>
<?= $this->endSection() ?>
<?= $this->section('pagejs') ?>
<?= $this->endSection() ?>