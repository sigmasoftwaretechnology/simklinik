<?= $this->extend('layout/layout') ?>
<?= $this->section('content') ?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h6>Rekam Medis</h6>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>


<!-- Main content -->
<section class="content">
    <div class="container-fluid">
		<div class="row">
			<div class="col-md-2">
				<a href="<?=base_url()?>/rekam-medis/pendaftaran">
				<div class="card">
				  <div class="card-body text-center p-3">
					<img src="<?php echo base_url('assets/img/clipboard.png');?>">
					<small class="mb-0 d-block">Pendaftaran</small>
				  </div>
				</div>
				</a>
			</div>
			<div class="col-md-2">
				<a href="<?=base_url()?>/rekam-medis/pasien-registrasi">
				<div class="card">
				  <div class="card-body text-center p-3">
					<img src="<?php echo base_url('assets/img/pemeriksaan.png');?>">
					<small class="mb-0 d-block">Pemeriksaan</small>
				  </div>
				</div>
				</a>
			</div>
			<div class="col-md-2">
				<a href="<?=base_url()?>/rekam-medis/pasien">
				<div class="card">
				  <div class="card-body text-center p-3">
					<img src="<?php echo base_url('assets/img/pasien.png');?>">
					<small class="mb-0 d-block">Pasien</small>
				  </div>
				</div>
				</a>
			</div>
			<div class="col-md-2">
				<a href="<?=base_url()?>/rekam-medis/tindakan">
				<div class="card">
				  <div class="card-body text-center p-3">
					<img src="<?php echo base_url('assets/img/tindakan.png');?>">
					<small class="mb-0 d-block">Tindakan</small>
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