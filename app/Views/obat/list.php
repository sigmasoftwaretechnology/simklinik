<?= $this->extend('layout/layout') ?>
<?= $this->section('content') ?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <h6>Obat</h6>
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
													<div class="col-sm-3">
								<input class="form-control form-control-sm" id="filterNama" type="text" value="">
							</div>
							<div class="col-1">
								<button id="filter" type="button" class="btn btn-outline-primary btn-xs"><i class="fas fa-search"></i> Filter</button>
							</div>

							<div class="col-3">
								<button type="button" class="btn btn-outline-primary btn-flat btn-xs"  
								data-backdrop="static" data-toggle="modal" data-href="<?php echo base_url();?>/farmasi/obat/tambah" href="#modal-form-baru"><i class="far fa-plus-square"></i> Tambah Obat</button>
								<button id="export" type="button" class="btn btn-outline-success btn-flat  btn-xs"><i class="fas fa-file"></i> Export</button>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="col-8" id="content">
			<?php echo view('obat/tabel'); ?>
			</div>
			<div class="modal" id="modal-form-baru">
				<div class="modal-dialog modal-lg">
					<div class="modal-content" id="modal-content-form-baru">
					</div>
				</div>
			</div>
			<div class="modal" id="modal-form-detail">
				<div class="modal-dialog modal-dialog-centered modal-lg">
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
								onclick="ajaxDelete('<?=base_url()?>/obat/hapus?id='+$('#delete_id').val())">
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
<script src="<?php echo base_url("assets/js/jquery.mask.min.js");?>"></script>
<script src="<?php echo base_url("assets/js/page/obat.js");?>"></script>
<?= $this->endSection() ?>