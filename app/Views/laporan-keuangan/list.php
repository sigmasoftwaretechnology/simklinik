<?= $this->extend('layout/layout') ?>
<?= $this->section('content') ?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <h6>Laporan</h6>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?php echo base_url();?>/keuangan">Keuangan</a></li>
                    <li class="breadcrumb-item active">Laporan</li>
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
								<select class="form-control form-control-sm" id="filterBulan">
									<option value="-" selected="selected">Bulan</option>
									<?php
									$bulan=array("Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
									$jlh_bln=count($bulan);
									for($c=0; $c<$jlh_bln; $c+=1){
										echo"<option value=$bulan[$c]> $bulan[$c] </option>";
									}
									?>
								</select>							
							</div>
							<div class="col-sm-1">
								<select class="form-control form-control-sm" id="filterTahun">
									<option  value="-"  selected="selected">Tahun</option>
									<?php
										$now=date('Y');
										for ($a=2012;$a<=$now;$a++)
										{
											 echo "<option value='$a'>$a</option>";
										}
									?>
								</select>							
							</div>
							<div class="col-3">
								<button id="filter" type="button" class="btn btn-danger btn-xs"><img src="<?php echo base_url(); ?>/assets/img/icon/search.png"> Filter</button>
								<button id="export" type="button" class="btn btn-danger btn-xs"><img src="<?php echo base_url(); ?>/assets/img/icon/export.png"> Export</button>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-12" id="content">
			<?php echo view('laporan-keuangan/tabel'); ?>
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
<?= $this->endSection() ?>
<?= $this->section('pagejs') ?>
<script src="<?php echo base_url("assets/js/jquery.mask.min.js");?>"></script>
<script src="<?php echo base_url("assets/js/page/laporan-keuangan.js");?>"></script>
<?= $this->endSection() ?>