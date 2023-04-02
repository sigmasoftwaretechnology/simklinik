<?= $this->extend('layout/layout') ?>
<?= $this->section('content') ?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <h6>Display Antrian</h6>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?php echo base_url();?>/setting">Setting</a></li>
                    <li class="breadcrumb-item active">Display Antrian</li>
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
                                <form id="frmDisplay" method="POST"
                                    action="<?php echo base_url();?>/setting/display-antrian" class="form-horizontal" enctype="multipart/form-data">
                                    <input type="hidden" class="form-control form-control-sm" name="id"
                                        value="<?=$data->_id?>">
                                    <div class="form-group row">
                                        <label for="inputTelp" class="col-sm-2 col-form-label">Upload File</label>
                                        <div class="col-sm-9">
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="customFile" name="file_video">
                                                <label class="custom-file-label" for="customFile">Choose file</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="offset-sm-2 col-sm-4">
                                            <button type="submit" class="btn btn-block btn-danger btn-xs"><img
                                                    src="<?php echo base_url(); ?>/assets/img/icon/save.png">
                                                Simpan</button>
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
<script src="<?php echo base_url("assets/js/bs-custom-file-input.min.js");?>"></script>
<script src="<?php echo base_url("assets/js/page/setting-display.js");?>"></script>
<?= $this->endSection() ?>