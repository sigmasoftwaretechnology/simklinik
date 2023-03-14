<div class="modal-header">
    <?php echo isset($data["id"]) ? "Ubah Unit" : "Tambah Unit"?>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<?php if(isset($data["id"])):?>
<form method="POST" id="frm" action="<?php echo base_url();?>/setting/unit/ubah?id=<?=$data["id"]?>" class="form-horizontal">
<?php else:?>
<form method="POST" id="frm" action="<?php echo base_url();?>/setting/unit/tambah" class="form-horizontal">
<?php endif;?>	
	<div class="card-body p-3">
		<div class="form-group mb-2">
			<label class="mb-0">Nama</label>
			<input type="text" class="form-control form-control-sm col-4" name="nama" value="<?php echo isset($data["nama"]) ? $data["nama"] : ""?>">
			<div id="error-nama" class="invalid-feedback"></div>
		</div>
		<div class="form-group mb-2">
			<label class="mb-0">Unit Atasan</label>
            <select class="form-control form-control-sm col-4" id="parent" name="parent">
				<?php foreach($dataParent as $dtParent):?>
				<option value="<?=$dtParent->nama?>"><?=$dtParent->nama?></option>
				<?php endforeach;?>
            </select>
			<div id="error-dokter" class="invalid-feedback"></div>
		</div>
	</div>
	<!-- /.card-body -->
	<div class="card-footer">
	  <button type="submit" class="btn btn-block btn-outline-primary btn-xs">Simpan</button>
	</div>
 </form>