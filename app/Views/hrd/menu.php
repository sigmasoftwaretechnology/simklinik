<?= $this->extend('layout/layout') ?>
<?= $this->section('content') ?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h6>HRD</h6>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2">
                <a href="<?=base_url()?>/hrd/karyawan">
                    <div class="card">
                        <div class="card-body text-center p-3">
                            <img src="<?php echo base_url('assets/img/sdm.png');?>">
                            <small class="mb-0 d-block">Karyawan</small>
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