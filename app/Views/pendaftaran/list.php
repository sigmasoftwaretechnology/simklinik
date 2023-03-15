<?= $this->extend('layout/layout') ?>
<?= $this->section('content') ?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <h6>Pendaftaran</h6>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?php echo base_url();?>/rekam-medis">Rekam Medis</a></li>
                    <li class="breadcrumb-item active">Pendaftaran</li>
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
								<input class="form-control form-control-sm filterTanggal" id="filterTanggal1" type="text" value="<?=date('d-m-Y')?>">
							</div>
							<div class="col-sm-1">
								<input class="form-control form-control-sm filterTanggal" id="filterTanggal2" type="text" value="<?=date('d-m-Y')?>">
							</div>
							<div class="col-sm-3">
								<input class="form-control form-control-sm" id="filterNama" type="text" value="">
							</div>
							<div class="col-1">
								<button id="filter" class="btn btn-danger btn-xs"><img src="<?php echo base_url(); ?>/assets/img/icon/search.png"> Filter</button>
							</div>
							<div class="col-4">
								<button type="button" class="btn btn-danger btn-xs"  
								data-backdrop="static" data-toggle="modal" data-href="<?php echo base_url();?>/rekam-medis/pendaftaran/tambah" href="#modal-form-register"><img src="<?php echo base_url(); ?>/assets/img/icon/plus.png"> Tambah Pendaftaran</button>
								<button type="button" class="btn btn-danger btn-xs"  
								data-backdrop="static" data-toggle="modal" data-href="<?php echo base_url();?>/rekam-medis/pasien/tambah" href="#modal-form-baru"><img src="<?php echo base_url(); ?>/assets/img/icon/plus.png"> Pasien Baru</button>
							</div>
						</div>
					</div>
				</div>
			</div>
			
			<div class="col-12" id="content">
			<?php echo view('pendaftaran/tabel'); ?>
			</div>
			<div class="modal" id="modal-form-register">
				<div class="modal-dialog">
					<div class="modal-content" id="modal-content-form-register">
					</div>
				</div>
			</div>
			<div class="modal" id="modal-form-baru">
				<div class="modal-dialog modal-xl">
					<div class="modal-content" id="modal-content-form-baru">
					</div>
				</div>
			</div>
			<div class="modal" id="modal-form-update">
				<div class="modal-dialog">
					<div class="modal-content" id="modal-content-form-update">
					</div>
				</div>
			</div>
			<div class="modal" id="modal-delete" tabindex="-1" role="dialog" data-backdrop="static">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							Konfirmasi Hapus
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
							Are you sure want to delete?
							<input type="hidden" id="delete_id" />
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
							<button type="button" class="btn btn-danger"
								onclick="ajaxDelete('<?=base_url()?>/rekam-medis/pendaftaran/hapus?id='+$('#delete_id').val())">
								Delete
							</button>
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
<link rel="stylesheet" href="<?php echo base_url('assets/css/select2.min.css');?>">
<link rel="stylesheet"
href="https://cdn.jsdelivr.net/npm/@ttskch/select2-bootstrap4-theme@x.x.x/dist/select2-bootstrap4.min.css">
<link rel="stylesheet" href="<?php echo base_url("assets/css/daterangepicker.css");?>">
<style>
.select2-container .select2-selection--single {
    height: calc(1.5em + .375rem + 2px) !important;
    padding: .125rem .25rem !important;
    font-size: .875rem !important;
    line-height: 1.5;
    border-radius: .2rem;
}
.select2-container--bootstrap4 .select2-selection--single .select2-selection__rendered {
    line-height: 1.5 !important;
}
.select2-container--bootstrap4 .select2-selection--single .select2-selection__placeholder {
    color: #757575;
    line-height: 1.5 !important;
}
</style>
<?= $this->endSection() ?>
<?= $this->section('pagejs') ?>
<script src="<?php echo base_url("assets/js/moment.min.js");?>"></script>
<script src="<?php echo base_url("assets/js/daterangepicker.js");?>"></script>
<script src="<?php echo base_url("assets/js/select2.full.min.js");?>"></script>
<script src="<?php echo base_url("assets/js/jquery.mask.min.js");?>"></script>
<script src="<?php echo base_url("assets/js/page/pendaftaran.js");?>"></script>
<?= $this->endSection() ?>