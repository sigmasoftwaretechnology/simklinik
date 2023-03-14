<div class="modal-header">
    <?php echo isset($data["id"]) ? "Ubah Tindakan" : "Tambah Tindakan"	?>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<?php if(isset($data["id"])):?>
<form method="POST" id="frmTindakan" action="<?php echo base_url();?>/rekam-medis/tindakan/ubah?id=<?=$data["id"]?>" class="form-horizontal">
<?php else:?>
<form method="POST" id="frmTindakan" action="<?php echo base_url();?>/rekam-medis/tindakan/tambah" class="form-horizontal">
<?php endif;?>	
	<div class="card-body">
		<div class="form-group">
			<label for="exampleInputNama">Nama</label>
			<input type="text" class="form-control form-control-sm col-7" name="nama" value="<?php echo isset($data["nama"]) ? $data["nama"] : ""?>">
			<div id="error-nama" class="invalid-feedback"></div>
		</div>
		<div class="form-group">
			<label for="exampleInputNama">Tarif</label>
			<input type="text" class="form-control form-control-sm col-5" name="tarif" value="<?php echo isset($data["tarif"]) ? $data["tarif"] : ""?>">
			<div id="error-nama" class="invalid-feedback"></div>
		</div>
	</div>
	<!-- /.card-body -->
	<div class="card-footer">
	  <button type="submit" class="btn btn-block btn-outline-primary btn-xs">Simpan</button>
	</div>
 </form>