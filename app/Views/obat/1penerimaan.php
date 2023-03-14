<?= $this->extend('layout/layout') ?>
<?= $this->section('content') ?>


<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
			<div class="col-12">
				<div class="card">
					<div class="card-body p-2">
						<div class="row">
							<div class="col-12">
								<form class="form-horizontal">
										<div class="row">
											<div class="col-3">
												<div class="form-group">
													<label class="mb-0">Cari Supplier</label>
													<select class="form-control form-control-sm cek-header" id="cari-supplier">
													</select>
													<div id="error-cari-supplier" class="invalid-feedback"></div>
												</div>
											</div>
											<div class="col-3">
												<div class="form-group">
													<label class="mb-0">Cari Obat</label>
													<select class="form-control form-control-sm cek-header" id="cari-obat">
													</select>
													<div id="error-cari-obat" class="invalid-feedback"></div>
												</div>
											</div>
											<div class="col-2">
												<div class="form-group">
													<label class="mb-0">Batch</label>
													<input type="text" class="form-control form-control-sm col-12 cek-header" id="batch" value="">
													<div id="error-batch" class="invalid-feedback"></div>
												</div>
											</div>
											<div class="col-2">
												<div class="form-group">
													<label  class="mb-0">Expired</label>
													<input type="text" class="form-control form-control-sm col-12 cek-header" id="kadaluarsa" value="">
													<div id="error-kadaluarsa" class="invalid-feedback"></div>
												</div>
											</div>
											<div class="col-1">
												<div class="form-group">
													<label  class="mb-0">Jumlah</label>
													<input type="text" class="form-control form-control-sm col-12  cek-header" id="jumlah" value="">
													<div id="error-jumlah" class="invalid-feedback"></div>
												</div>
											</div>
											<div class="col-1 form-inline">
												<div class="form-group">
													<button type="button" id="masuk-list" class="btn btn-outline-info btn-flat btn-xs"><i class="fa fa-plus"></i></button>	
												</div>
											</div>
										</div>
								 </form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
        <div class="row">
			<div class="col-12">
				<div class="card">
					<div class="card-body p-2">
						<form id="frm" method="POST" action="<?php echo base_url();?>/obat/penerimaan">
							<div class="row">
								<div class="col-12">
								<h5>List Penerimaan Obat</h5>
								</div>
								<div class="col-12">
									<table class="table table-hover table-sm table-bordered">
									  <thead>
										<tr>
										  <th>Supplier</th>
										  <th>Nama Obat</th>
										  <th>Batch</th>
										  <th>Expired</th>
										  <th>Jumlah</th>
										  <th class="text-center">Aksi</th>
										</tr>
									  </thead>
									  <tbody id="data-obat">
									
									  </tbody>
									</table>
								</div>
							</div>
							<div class="row justify-content-center">
								<div class="col-2">
									<button type="submit" class="btn btn-block btn-outline-primary btn-xs">Simpan</button>
								</div>
							</div>
						</form>
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
<script src="https://cdn.jsdelivr.net/npm/signature_pad@2.3.2/dist/signature_pad.min.js"></script>
<script src="<?php echo base_url("assets/js/select2.full.min.js");?>"></script>
<script src="<?php echo base_url("assets/js/jquery.mask.min.js");?>"></script>
<script src="<?php echo base_url("assets/js/page/penerimaan-obat.js");?>"></script>
<?= $this->endSection() ?>