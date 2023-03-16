<div class="modal-header">
    <?php echo isset($data["id"]) ? "Ubah Karyawan" : "Tambah Karyawan"?>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<?php if(isset($data["_id"])):?>
<form method="POST" id="frm" action="<?php echo base_url();?>/hrd/karyawan/ubah?id=<?=$data["_id"]?>" class="form-horizontal">
<?php else:?>
<form method="POST" id="frm" action="<?php echo base_url();?>/hrd/karyawan/tambah" class="form-horizontal">
<?php endif;?>	
	<div class="card-body p-3">
		<div class="form-group mb-2">
			<label class="mb-0">NIK</label>
			<input type="text" autocomplete="off" class="form-control form-control-sm col-3" name="nik" value="<?php echo isset($data["nik"]) ? $data["nik"] : ""?>">
			<div id="error-nik" class="invalid-feedback"></div>
		</div>
		<div class="row">
			<div class="col-2">
				<div class="form-group mb-2">
					<label class="mb-0">Gelar Depan</label>
					<input autocomplete="off" type="text" class="form-control form-control-sm" name="gelar_depan" value="<?php echo isset($data["gelar_depan"]) ? $data["gelar_depan"] : ""?>">
					<div id="error-gelar_depan" class="invalid-feedback"></div>
				</div>
			</div>
			<div class="col-8">
				<div class="form-group mb-2">
					<label class="mb-0">Nama</label>
					<input autocomplete="off" type="text" class="form-control form-control-sm" name="nama" value="<?php echo isset($data["nama"]) ? $data["nama"] : ""?>">
					<div id="error-nama" class="invalid-feedback"></div>
				</div>
			</div>
			<div class="col-2">
				<div class="form-group mb-2">
					<label class="mb-0">Gelar Belakang</label>
					<input autocomplete="off" type="text" class="form-control form-control-sm" name="gelar_belakang" value="<?php echo isset($data["gelar_belakang"]) ? $data["gelar_belakang"] : ""?>">
					<div id="error-gelar_belakang" class="invalid-feedback"></div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-3">
				<div class="form-group mb-2">
					<label class="mb-0">Posisi</label>
					<select class="form-control form-control-sm" id="unit" name="unit">
						<?php foreach($dataUnit as $dtUnit):?>
						<option data-induk="<?=$dtUnit->parent?>" value="<?=$dtUnit->nama?>"><?=$dtUnit->nama?></option>
						<?php endforeach;?>
					</select>
					<div id="error-dokter" class="invalid-feedback"></div>
				</div>
			</div>
			<div class="col-3">
				<div class="form-group mb-2">
					<label class="mb-0">Atasan</label>
					<input  id="atasan" type="hidden" name="atasan" value=""/>
					<h5 class="text-danger font-weight-light" id="txt-atasan"></h5>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-7">
				<div class="form-group mb-2">
					<label class="mb-0">STR</label>
					<input autocomplete="off" type="text" class="form-control form-control-sm" name="str" value="<?php echo isset($data["str"]) ? $data["str"] : ""?>">
					<div id="error-str" class="invalid-feedback"></div>
				</div>
			</div>
			<div class="col-2">
				<div class="form-group mb-2">
					<label class="mb-0">Tahun Berakhir</label>
					<input autocomplete="off" type="text" class="form-control form-control-sm" name="tahun_akhir_str" value="<?php echo isset($data["tahun_akhir_str"]) ? $data["tahun_akhir_str"] : ""?>">
					<div id="error-tahun_akhir_str" class="invalid-feedback"></div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-7">
				<div class="form-group mb-2">
					<label class="mb-0">SIP</label>
					<input autocomplete="off" type="text" class="form-control form-control-sm" name="sip" value="<?php echo isset($data["sip"]) ? $data["sip"] : ""?>">
					<div id="error-str" class="invalid-feedback"></div>
				</div>
			</div>
			<div class="col-2">
				<div class="form-group mb-2">
					<label class="mb-0">Tahun Berakhir</label>
					<input autocomplete="off" type="text" class="form-control form-control-sm" name="tahun_akhir_sip" value="<?php echo isset($data["tahun_akhir_sip"]) ? $data["tahun_akhir_sip"] : ""?>">
					<div id="error-tahun_akhir_sip" class="invalid-feedback"></div>
				</div>
			</div>
		</div>
	</div>
	<!-- /.card-body -->
	<div class="card-footer">
	<button type="submit" class="btn btn-block btn-danger btn-xs"><img src="<?php echo base_url(); ?>/assets/img/icon/save.png"> Simpan</button>
	</div>
 </form>