<div class="modal-header">
    <?php echo isset($data["id"]) ? "Ubah Poli" : "Tambah Poli"?>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<?php if(isset($data["id"])):?>
<form method="POST" id="frm" action="<?php echo base_url();?>/setting/poli/ubah?id=<?=$data["id"]?>" class="form-horizontal">
<?php else:?>
<form method="POST" id="frm" action="<?php echo base_url();?>/setting/poli/tambah" class="form-horizontal">
<?php endif;?>	
	<div class="card-body p-3">
		<div class="form-group mb-2">
			<label class="mb-0">Kode</label>
			<input type="text" class="form-control form-control-sm col-4" name="kode" value="<?php echo isset($data["kode"]) ? $data["kode"] : ""?>">
			<div id="error-kode" class="invalid-feedback"></div>
		</div>
		<div class="form-group mb-2">
			<label class="mb-0">Nama</label>
			<input type="text" class="form-control form-control-sm col-4" name="nama" value="<?php echo isset($data["nama"]) ? $data["nama"] : ""?>">
			<div id="error-nama" class="invalid-feedback"></div>
		</div>
		<div class="form-group mb-2">
			<label class="mb-0">Dokter</label>
            <select class="form-control form-control-sm  col-4" id="dokter" name="dokter">
				<?php foreach($dokter as $dtDokter):?>
				<option value="<?=$dtDokter->_id."-".$dtDokter->gelar_depan." ".$dtDokter->nama." ".$dtDokter->gelar_belakang?>"><?=$dtDokter->gelar_depan." ".$dtDokter->nama." ".$dtDokter->gelar_belakang?></option>
				<?php endforeach;?>
            </select>
			<div id="error-dokter" class="invalid-feedback"></div>
		</div>
	</div>
	<!-- /.card-body -->
	<div class="card-footer">
	<button type="submit" class="btn btn-block btn-danger btn-xs"><img src="<?php echo base_url(); ?>/assets/img/icon/save.png"> Simpan</button>
	</div>
 </form>