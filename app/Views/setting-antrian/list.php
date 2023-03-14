<?= $this->extend('layout/layout') ?>
<?= $this->section('content') ?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <h6>Antrian</h6>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?php echo base_url();?>/setting">Setting</a></li>
                    <li class="breadcrumb-item active">Antrian</li>
                </ol>
            </div>
        </div>
    </div>
</section>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">						
			<div class="col-6" id="content">
			<?php echo view('setting-antrian/tabel'); ?>
			</div>
			<div class="modal" id="modal-delete" tabindex="-1" role="dialog" data-backdrop="static">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							Konfirmasi Non Aktifkan Poli
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
							Apakah anda yakin?
							<input type="hidden" id="delete_id" />
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-danger"
								onclick="ajaxDelete('<?=base_url()?>/setting/antrian/non-aktif?id='+$('#delete_id').val())">
								Non Aktifkan
							</button>
						</div>
					</div>
				</div>
			</div>
			<div class="modal" id="modal-open" tabindex="-1" role="dialog" data-backdrop="static">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							Konfirmasi Aktifkan Poli
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
							Apakah anda yakin?
							<input type="hidden" id="delete_id" />
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-success"
								onclick="ajaxOpen('<?=base_url()?>/setting/antrian/aktif?id='+$('#delete_id').val())">
								Aktifkan
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
<script src="<?php echo base_url("assets/js/page/setting-antrian.js");?>"></script>
<?= $this->endSection() ?>