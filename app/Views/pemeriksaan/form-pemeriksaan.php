<?= $this->extend('layout/layout') ?> 
<?= $this->section('content') ?>
<?php
helper('klinik_helper');
?>
<!-- Content Header (Page header) -->
<section class="content-header">
  <div class="container-fluid"></div>
  <!-- /.container-fluid -->
</section>
<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-6">
        <h5>Form Pemeriksaan</h5>
      </div>
    </div>
    <div class="row">
      <div class="col-md-3">
        <!-- Proassets Image -->
        <div class="card card-danger card-outline">
          <div class="card-body box-proassets">
            <h5 class="proassets-username text-center mb-0" id="nama_pasien"><?= $row->nama?></h5>
            <p class="text-muted text-center mb-0" id="no_reg"><?= $row->no_reg?></p>
            <p class="text-muted text-center mb-0" id="rm_pasien"><?= $row->no_rm?></p>
            <p class="text-muted text-center mb-0" id="alamat_pasien"><?= $row->alamat?></p>
            <p  class="text-muted text-center mb-0"><span id="umur_pasien"><?php $umur = hitung_umur($row->tgl_lahir);echo $umur["tahun"]." th";?></span>
            <span><?php echo $umur["bulan"]." bl";?></span>
            <span><?php echo $umur["hari"]." hr";?></span></p>
			<p class="text-monospace font-weight-bold text-center mb-0 text-danger" id="no_bpjs"><?= $row->no_bpjs?></p>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
        <!-- Proassets Image -->
        <div class="card card-danger card-outline">
          <div class="card-body box-proassets">
		        <p class="text-muted text-center mb-0">History Kunjungan</p>
				<div class="row">
					<div class="col-12">
						<table class="table table-sm table-hover table-bordered table-head-fixed text-nowrap">
						  <thead>
							<tr>
							  <th>No Reg</th>
							  <th>Tanggal</th>
							  <th class="text-center" colspan="2">Aksi</th>
							</tr>
						  </thead>
						  <tbody id="body-kunjungan">
						  </tbody>
						</table>
					</div>
				</div>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
      <!-- /.col -->
      <div class="col-md-9">
        <div class="card">
          <div class="card-body pb-0 pt-0">
            <div class="row">
              <div class="col-5">
                <div class="form-group">
                  <label class="mb-0">Tanggal Periksa</label>
                  <input type="text" name="tanggal_periksa" readonly value="<?=date("d-m-Y")?>" class="form-control form-control-sm rounded-0 col-5" placeholder="Tanggal">
                </div>
              </div>
            </div>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
        <div class="card">
          <div class="card-header p-2">
            <ul class="nav nav-pills">
				<li class="nav-item">
					<a class="nav-link active" href="#pemeriksaan" data-toggle="tab">Pemeriksaan</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="#dokument" data-toggle="tab">Dokumen Penunjang</a>
				</li>
            </ul>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <div class="tab-content">
				<div class="tab-pane active" id="pemeriksaan">
					<form class="form-horizontal" id="frm-pemeriksaan-fisik" action="<?php echo base_url();?>/rekam-medis/save-pemeriksaan-fisik" method="POST"> 
						<div class="row">
							<div class="col-md-12">
								<div class="form-group row">
									<label class="col-md-2 font-weight-bold" id=""><code><sup>*</sup></code>
										Subjectif</label>
									<div class="col-md-10">
										<input type="hidden" name="lunas"/>
										<textarea class="form-control form-control-sm input-sm" name="subject"></textarea>
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<div class="form-group row">
									<label class="col-md-2 font-weight-bold" id=""><code><sup>*</sup></code>Objectif</label>
									<div class="col-md-10">
										<div class="row">
											<div class="col-md-12">
												<div class="form-group row">
													<label class="col-md-2 font-weight-normal"><code><sup>*</sup></code>K/U</label>
													<div class="col-md-10">
														<input type="text" class="form-control form-control-sm" value="" name="ku">
													</div>
												</div>
												<div class="form-group row">
													<label class="col-md-2 font-weight-normal"><code><sup>*</sup></code>T(mm/Hg)</label>
													<div class="col-md-2">
														<input type="text" class="form-control form-control-sm" value="" name="t">
													</div>
													<label class="col-md-2 font-weight-normal"><code><sup>*</sup></code>N(x/mnt)</label>
													<div class="col-md-2">
														<input type="text" class="form-control form-control-sm" value="" name="n">
													</div>
													<label class="col-md-2 font-weight-normal"><code><sup>*</sup></code>S(<sup>o</sup>C)</label>
													<div class="col-md-2">
														<input type="text" class="form-control form-control-sm" value="" name="s">
													</div>
												</div>
												<div class="form-group row">
													<label class="col-md-2 font-weight-normal"><code><sup>*</sup></code>RR(x/mnt)</label>
													<div class="col-md-2">
														<input type="text" class="form-control form-control-sm" value="" name="rr">
													</div>
													<label class="col-md-2 font-weight-normal"><code><sup>*</sup></code>BB(kg)</label>
													<div class="col-md-2">
														<input type="text" class="form-control form-control-sm" value="" name="bb">
													</div>
													<label class="col-md-2 font-weight-normal"><code><sup>*</sup></code>TB(cm)</label>
													<div class="col-md-2">
														<input type="text" class="form-control form-control-sm" value="" name="tb">
													</div>
												</div>
												<div class="form-group row">
												<label class="col-md-2 font-weight-normal"><code><sup>*</sup></code>SPO2</label>
													<div class="col-md-2">
														<input type="text" class="form-control form-control-sm" value="" name="spo2">
													</div>
													<label class="col-md-2 font-weight-normal"><code><sup>*</sup></code>GDA</label>
													<div class="col-md-2">
														<input type="text" class="form-control form-control-sm" value="" name="gda">
													</div>
												</div>
											</div>
										</div>								
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<div class="form-group row">
									<label class="col-md-2 font-weight-bold" id="assessment"><code><sup>*</sup></code>Assessment</label>
									<div class="col-md-10">
										<div class="row">
											<div class="col-md-12">
												<div class="form-group row">
													<label class="col-md-2 font-weight-normal"><code><sup>*</sup></code>ICD 10</label>
													<div class="col-md-10">
														<div class="row">
															<div class="col-md-12">
																<div class="row mb-2">
																	<div class="col-8">
																		<select class="form-control form-control-sm" id="cari-icdx"></select>
																	</div>
																</div>
																<div class="row mb-2">
																	<div class="col-8">
																		<input type="text" id="manual-icdx" class="form-control form-control-sm rounded-0" placeholder="Isi Manual ICD 10" autocomplete="off">
																	</div>
																	<div class="col-3 ">
																		<button type="button" id="masuk-icdx" class="btn btn-outline-info btn-flat btn-xs"><i class="fa fa-plus"></i></button>	
																	</div>
																</div>
																<div class="row">
																	<table class="table table-sm table-hover table-bordered table-head-fixed text-nowrap">
																		<thead>
																			<tr>
																			  <th class="font-weight-normal text-center" width="90%">Nama ICD 10</th>
																			  <th class="font-weight-normal text-center">Aksi</th>
																			</tr>
																		</thead>
																		  <tbody id="body-icdx">
																		  </tbody>
																	</table>															
																</div>
															</div>
														</div>
													</div>
												</div>								
											</div>								
										</div>
										<div class="row">
											<div class="col-md-12">
												<div class="form-group row">
													<label class="col-md-2 font-weight-normal"><code><sup>*</sup></code>Tindakan</label>
													<div class="col-md-10">
														<div class="row">
															<div class="col-md-12">
																<div class="row mb-2">
																	<div class="col-8">
																		<select class="form-control form-control-sm" id="cari-tindakan"></select>
																	</div>
																	<div class="col-2">
																	<button type="button" id="masuk-tindakan" class="btn btn-outline-info btn-flat btn-xs"><i class="fa fa-plus"></i></button>
																	</div>
																</div>
																<div class="row">
																	<table class="table table-sm table-hover table-bordered table-head-fixed text-nowrap">
																	  <thead>
																		<tr>
																		  <th class="font-weight-normal text-center" width="90%">Nama Tindakan</th>
																		  <th class="font-weight-normal text-center">Aksi</th>
																		</tr>
																	  </thead>
																	  <tbody id="body-tindakan">
																	  </tbody>
																	</table>
																</div>
															</div>
														</div>
													</div>
												</div>								
											</div>								
										</div>								
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<div class="form-group row">
									<label class="col-md-2 font-weight-bold" id="plant"><code><sup>*</sup></code>Plan</label>
									<div class="col-md-10">
										<div class="row">
											<div class="col-md-12">
												<div class="form-group row">
													<label class="col-md-12 font-weight-normal"><code><sup>*</sup></code>Tulis Resep</label>
													<div class="col-md-12">
														<div class="row">
															<div class="col-md-6">
																 <div class="form-group">
																 	<input type="hidden" id="nama-obat">
																	<label class="mb-0 font-weight-normal">Obat</label>
																		<select class="form-control form-control-sm" id="cari-obat">
																		</select>
																  </div>
															</div>
															<div class="col-md-1">
																<div class="form-group">
																	<label class="mb-0 font-weight-normal">No</label>
																	<input type="text" class="form-control form-control-sm" value="" id="jumlah">
																</div>
															</div>

															<div class="col-md-2">
																<div class="form-group">
																	<label class="mb-0 font-weight-normal">Aturan Pakai</label>
																	<input type="text" class="form-control form-control-sm" value="" id="dosis">
																</div>
															</div>
															<div class="col-md-2">
																 <div class="form-group">
																	<label class="mb-0 font-weight-normal">Aturan Minum</label>
																		<select class="form-control form-control-sm" id="aturan_minum">
																		<option value="-">-</option>
																		<option value="a.c.">a.c.</option>
																		<option value="d.c.">d.c.</option>
																		<option value="p.c.">p.c.</option>
																		</select>
																  </div>															
															</div>
															<div class="col-md-1">
																 <div class="form-group">
																	<label class="mb-0 font-weight-normal">&nbsp;&nbsp;&nbsp;</label>
																		<button type="button" id="masuk-resep" class="btn btn-outline-info btn-flat btn-xs"><i class="fa fa-plus"></i></button>	
																  </div>															
															</div>
														</div>
														<textarea class="summernote" name="resep"></textarea>
													</div>
												</div>								
											</div>								
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<div class="form-group row">
									<label class="col-md-3 font-weight-bold" id=""><code><sup>*</sup></code>
										Pemeriksaan Penunjang</label>
									<div class="col-md-9">
										<textarea class="summernote" name="pemeriksaan_penunjang"></textarea>
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-12">
								<button type="button" id="simpan-pemeriksaan-fisik" class="btn btn-block btn-outline-primary btn-xs">Simpan Pemeriksaan</button>
							</div>
						</div>
					</form>
				</div>
				<div class="tab-pane" id="dokument">
					<form class="form-horizontal" enctype="multipart/form-data" id="frm-dokument-penunjang" action="<?php echo base_url();?>/rekam-medis/save-dokumen-penunjang" method="POST"> 
						<div class="row">
							<div class="col-md-12">
								<div class="form-group row">
									<label class="col-md-3 font-weight-bold" id=""><code><sup>*</sup></code>
										Pilih Jenis Dokument</label>
									<div class="col-md-9">
										<select class="form-control form-control-sm" id="ktFile" name="jns_dokumen">
										<option value=""> - </option>
										<option value="usg"> USG </option>
										<option value="ecg"> ECG </option>
										<option value="laborat"> Laborat </option>
										<option value="radiologi"> Radiologi </option>
										<option value="resume_pulang"> Resume Pasien Pulang </option>
										<option value="general_concern"> General Concern </option>
										<option value="lain"> Lain lain </option>
										</select>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-md-3 font-weight-bold" id=""><code><sup>*</sup></code>
										File</label>
									<div class="col-md-9">
									     <div class="custom-file">
											<input type="file" class="custom-file-input input-xs" name="file_pasien" id="exampleInputFile">
											<label class="custom-file-label" for="exampleInputFile">Choose file</label>
										</div>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-md-3 font-weight-bold" id=""></label>
									<div class="col-md-9">
										<button type="button" id="simpan-dokument-penunjang" class="btn btn-block btn-outline-primary btn-xs">Upload</button>
									</div>
								</div>
							</div>
						</div>
					</form>
					<div class="row">
						<div class="col-md-3">
						</div>
						<div class="col-md-9" id="content-dokumen">
							<table class="table table-sm table-bordered">
								<thead>
								<tr>
									<th width="30%">Kategori</th>
									<th width="60%">Dokumen</th>
								</tr>
								</thead>
								  <tbody id="body-dokument">
								  </tbody>
							</table>
						</div>
					</div>
				</div>
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
      <!-- /.col -->
    </div>
	<div class="modal" id="modal-view-erm">
		<div class="modal-dialog modal-lg">
			<div class="modal-content" id="modal-content-view-erm">
			</div>
		</div>
	</div>
  </div>
</section>
<!-- /.content --> 

<?= $this->endSection() ?> 
<?= $this->section('pagecss') ?> 
<link rel="stylesheet" href="<?php echo base_url('assets/css/select2.min.css');?>">
<link rel="stylesheet" href="<?php echo base_url('assets/css/summernote-bs4.min.css');?>">
<link rel="stylesheet" href="<?php echo base_url('assets/css/sweetalert2.min.css');?>">
<link rel="stylesheet" href="<?php echo base_url('assets/css/ekko-lightbox.css');?>">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@ttskch/select2-bootstrap4-theme@x.x.x/dist/select2-bootstrap4.min.css">
<style>
.note-editor.note-frame.card {
    margin-bottom: 0px;
    box-shadow: none;
}

.note-statusbar {
    display: none !important;
}

.note-editable p {
    margin-bottom: 0 !important;
}

.select2-container--default .select2-selection--single {
    background-color: #fff;
    border: 1px solid #ced4da;
    border-radius: 0px;
}
.note-editable p { margin-bottom: 0 !important; }

.custom-file {
    height: calc(1.5em + .375rem + 2px);
}

.custom-file-input {
    position: relative;
    z-index: 2;
    width: 100%;
    margin: 0;
    opacity: 0;
    height: calc(1.5em + .375rem + 2px);
    padding: .125rem .25rem !important;
    font-size: .875rem !important;
    line-height: 1.5;
    border-radius: .2rem;
}

.custom-file-label {
    height: calc(1.5em + .375rem + 2px);
    padding: .125rem .25rem !important;
}

.custom-file-label::after {
    height: calc(1.5em + .375rem + 2px);
    padding: .125rem .25rem !important;
}

</style>
<?= $this->endSection() ?> 
<?= $this->section('pagejs') ?> 
<script src="<?php echo base_url("assets/js/select2.full.min.js");?>"></script>
<script src="<?php echo base_url("assets/js/summernote-bs4.min.js");?>"></script>
<script src="<?php echo base_url("assets/js/sweetalert2.min.js");?>"></script>
<script src="<?php echo base_url("assets/js/ekko-lightbox.min.js");?>"></script>
<script src="<?php echo base_url("assets/js/jquery.mask.min.js");?>"></script> 	
<script src="<?php echo base_url("assets/js/page/pemeriksaan.js");?>"></script>
<?= $this->endSection() ?>