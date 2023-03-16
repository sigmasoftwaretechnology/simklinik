<?= $this->extend('layout/layout') ?>
<?= $this->section('content') ?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <h6>Kasir</h6>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?php echo base_url();?>/keuangan">Keuangan</a></li>
                    <li class="breadcrumb-item active">Kasir</li>
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
							<div class="col-sm-2">
								<input class="form-control form-control-sm filterTanggal" id="filterTanggal1" type="text" value="<?=date('d-m-Y')?>">
							</div>
							<div class="col-3">
								<button id="filter" type="button" class="btn btn-danger btn-xs"><img src="<?php echo base_url(); ?>/assets/img/icon/search.png"> Filter</button>
							</div>
						</div>
					</div>
				</div>
			</div>
			
			<div class="col-12" id="content">
			<?php echo view('kasir/tabel'); ?>
			</div>
			<div class="modal" id="modal-form-baru">
				<div class="modal-dialog modal-lg">
					<div class="modal-content" id="modal-content-form-baru">
					</div>
				</div>
			</div>
			<div class="modal" id="modal-form-detail">
				<div class="modal-dialog modal-dialog-centered modal-xl">
					<div class="modal-content" id="modal-content-form-detail">
					</div>
				</div>
			</div>
			<div class="modal" id="modal-delete" tabindex="-1" role="dialog" data-backdrop="static">
				<div class="modal-dialog modal-dialog-centered" role="document">
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
								onclick="ajaxDelete('<?=base_url()?>/farmasi/supplier/hapus?id='+$('#delete_id').val())">
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
<link rel="stylesheet" href="<?php echo base_url("assets/css/daterangepicker.css");?>">
<link rel="stylesheet" href="<?php echo base_url('assets/css/select2.min.css');?>">
<link rel="stylesheet" href="<?php echo base_url('assets/css/sweetalert2.min.css');?>">
<link rel="stylesheet"
href="https://cdn.jsdelivr.net/npm/@ttskch/select2-bootstrap4-theme@x.x.x/dist/select2-bootstrap4.min.css">
<style>
.select2-container--default .select2-selection--single {
    background-color: #fff;
    border: 1px solid #ced4da;
    border-radius: 0px;
}
</style>
<?= $this->endSection() ?>
<?= $this->section('pagejs') ?>
<script src="<?php echo base_url("assets/js/moment.min.js");?>"></script>
<script src="<?php echo base_url("assets/js/daterangepicker.js");?>"></script>
<script src="<?php echo base_url("assets/js/select2.full.min.js");?>"></script>
<script src="<?php echo base_url("assets/js/jquery.mask.min.js");?>"></script>
<script src="<?php echo base_url("assets/js/sweetalert2.min.js");?>"></script>
<script src="<?php echo base_url("assets/js/page/kasir.js");?>"></script>
<?= $this->endSection() ?>