<?= $this->extend('layout/layout') ?>
<?= $this->section('content') ?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <h6>Keuangan</h6>
            </div>
        </div>
    </div>
</section>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
		<div class="row">
			<div class="col-md-2">
				<a href="<?=base_url()?>/keuangan/kasir">
				<div class="card">
				  <div class="card-body text-center p-3">
					<img src="<?php echo base_url('assets/img/resep.png');?>">
					<small class="mb-0 d-block">Kasir</small>
				  </div>
				</div>
				</a>
			</div>
			<div class="col-md-2">
				<a href="<?=base_url()?>/keuangan/laporan-keuangan">
				<div class="card">
				  <div class="card-body text-center p-3">
					<img src="<?php echo base_url('assets/img/resep.png');?>">
					<small class="mb-0 d-block">Laporan</small>
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