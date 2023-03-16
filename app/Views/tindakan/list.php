<?= $this->extend('layout/layout') ?>
<?= $this->section('content') ?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <h6>Tindakan</h6>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?php echo base_url();?>/rekam-medis">Rekam Medis</a></li>
                    <li class="breadcrumb-item active">Tindakan</li>
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
							<div class="col-4">
								<button type="button" class="btn btn-danger btn-xs"  
								data-backdrop="static" data-toggle="modal" data-href="<?php echo base_url();?>/rekam-medis/tindakan/tambah" href="#modal-form-baru"><img src="<?php echo base_url(); ?>/assets/img/icon/plus.png"> Tambah Tindakan</button>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="col-7" id="content">
			<?php echo view('tindakan/tabel'); ?>
			</div>
			<div class="modal" id="modal-form-baru">
				<div class="modal-dialog modal-dialog-centered">
					<div class="modal-content" id="modal-content-form-baru">
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
								onclick="ajaxDelete('<?=base_url()?>/rekam-medis/tindakan/hapus?id='+$('#delete_id').val())">
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
<?= $this->endSection() ?>
<?= $this->section('pagejs') ?>
<script src="<?php echo base_url("assets/js/page/tindakan.js");?>"></script>
<?= $this->endSection() ?>