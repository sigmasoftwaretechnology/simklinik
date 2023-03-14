<div class="modal-header">
    <?php echo isset($data["id"]) ? "Ubah Obat" : "Tambah Obat"?>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<?php if(isset($data["id"])):?>
<form method="POST" id="frmTindakan" action="<?php echo base_url();?>/obat/ubah?id=<?=$data["id"]?>" class="form-horizontal">
<?php else:?>
<form method="POST" id="frmTindakan" action="<?php echo base_url();?>/obat/tambah" class="form-horizontal">
<?php endif;?>	
	<div class="card-body p-3">
		<div class="form-group mb-2" id="baru">
			<label class="mb-0">Nama</label>
			<input type="text" class="form-control form-control-sm col-7" name="nama" value="<?php echo isset($data["nama"]) ? $data["nama"] : ""?>">
			<div id="error-nama" class="invalid-feedback"></div>
		</div>
	</div>
	<!-- /.card-body -->
	<div class="card-footer">
	  <button type="submit" class="btn btn-block btn-outline-primary btn-xs">Simpan</button>
	</div>
 </form>