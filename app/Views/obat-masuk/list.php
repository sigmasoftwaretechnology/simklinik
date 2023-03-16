<?= $this->extend('layout/layout') ?>
<?= $this->section('content') ?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <h6>Penerimaan Obat</h6>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?php echo base_url();?>/farmasi">Farmasi</a></li>
                    <li class="breadcrumb-item active">Penerimaan Obat</li>
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
                           <!-- <div class="col-sm-2">
                                <select class="form-control form-control-sm" id="filterBulan">
                                    <option value="-" selected="selected">Bulan</option>
                                    <?php
									$bulan=array("Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
									$jlh_bln=count($bulan);
									for($c=0; $c<$jlh_bln; $c+=1){
										$i= $c+1;
										echo"<option value=$i> $bulan[$c] </option>";
									}
									?>
                                </select>
                            </div>
                            <div class="col-sm-1">
                                <select class="form-control form-control-sm" id="filterTahun">
                                    <option value="-" selected="selected">Tahun</option>
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
                                <button id="filter" type="button" class="btn btn-outline-primary btn-xs"><i
                                        class="fas fa-search"></i> Filter</button>
                                <button id="export" type="button" class="btn btn-outline-success btn-xs"><i
                                        class="fas fa-file"></i> Export</button>
                            </div>-->
                            <div class="col-4">
                                <button type="button" class="btn btn-danger btn-xs"
                                    data-backdrop="static" data-toggle="modal"
                                    data-href="<?php echo base_url();?>/farmasi/obat-masuk/tambah"
                                    href="#modal-form-baru"><img src="<?php echo base_url(); ?>/assets/img/icon/plus.png"> Tambah Transaksi</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12" id="content">
                <?php echo view('obat-masuk/tabel'); ?>
            </div>
            <div class="modal" id="modal-form-baru">
                <div class="modal-dialog modal-dialog-centered modal-lg">
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
<script src="<?php echo base_url("assets/js/page/obat-masuk.js");?>"></script>
<?= $this->endSection() ?>