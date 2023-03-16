<?= $this->extend('layout/layout') ?>
<?= $this->section('content') ?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <h6>Informasi</h6>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?php echo base_url();?>/setting">Setting</a></li>
                    <li class="breadcrumb-item active">Informasi</li>
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
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-6">
                                <form id="frmInformasi" method="POST" action="<?php echo base_url();?>/setting/informasi/ubah" class="form-horizontal">
                                    <div class="form-group row">
                                        <label for="inputNama" class="col-sm-2 col-form-label">Nama</label>
                                        <div class="col-sm-6">
                                            <input type="hidden" class="form-control form-control-sm"
                                                name="id" value="<?=$data->_id?>">
                                            <input type="text" class="form-control form-control-sm" id="inputNama"
                                                name="nama" value="<?=$data->nama?>" placeholder="Nama Klinik">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputAlamat" class="col-sm-2 col-form-label">Alamat</label>
                                        <div class="col-sm-10">
                                            <textarea class="form-control form-control-sm" id="inputAlamat" name="alamat"
                                                placeholder="Alamat" ><?=$data->alamat?></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputTelp" class="col-sm-2 col-form-label">Telp</label>
                                        <div class="col-sm-4">
                                            <input type="text" class="form-control form-control-sm" id="inputTelp"
                                                name="telp" placeholder="Telp" value="<?=$data->telp?>">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="offset-sm-2 col-sm-4">
                                            <button type="submit"
                                                class="btn btn-block btn-danger btn-xs"><img src="<?php echo base_url(); ?>/assets/img/icon/save.png"> Simpan</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
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
<script src="<?php echo base_url("assets/js/page/setting-informasi.js");?>"></script>
<?= $this->endSection() ?>