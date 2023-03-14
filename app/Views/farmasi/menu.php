<?= $this->extend('layout/layout') ?>
<?= $this->section('content') ?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h6>Farmasi</h6>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
		<div class="row">
			<div class="col-md-2">
				<a href="<?=base_url()?>/farmasi/obat-masuk">
				<div class="card">
				  <div class="card-body text-center p-3">
					<img src="<?php echo base_url('assets/img/resep.png');?>">
					<small class="mb-0 d-block">Penerimaan Obat</small>
				  </div>
				</div>
				</a>
			</div>
			<div class="col-md-2">
				<a href="<?=base_url()?>/farmasi/obat">
				<div class="card">
				  <div class="card-body text-center p-3">
					<img src="<?php echo base_url('assets/img/obat.png');?>">
					<small class="mb-0 d-block">Obat</small>
				  </div>
				</div>
				</a>
			</div>
			<div class="col-md-2">
				<a href="<?=base_url()?>/farmasi/supplier">
				<div class="card">
				  <div class="card-body text-center p-3">
					<img src="<?php echo base_url('assets/img/supplier_obat.png');?>">
					<small class="mb-0 d-block">Master Supplier</small>
				  </div>
				</div>
				</a>
			</div>
			<div class="col-md-2">
				<a href="<?=base_url()?>/farmasi/resep">
				<div class="card">
				  <div class="card-body text-center p-3">
					<img src="<?php echo base_url('assets/img/resep.png');?>">
					<small class="mb-0 d-block">Input Resep</small>
				  </div>
				</div>
				</a>
			</div>
			<div class="col-md-2">
				<a href="<?=base_url()?>/farmasi/resep-bebas">
				<div class="card">
				  <div class="card-body text-center p-3">
					<img src="<?php echo base_url('assets/img/resep.png');?>">
					<small class="mb-0 d-block">Input Resep Bebas</small>
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