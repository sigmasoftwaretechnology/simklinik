<div class="modal-header">
    Detail Obat
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
	<div class="card-body">
		<div class="row mb-2">
			<div class="col-12">
			<form method="POST" id="frmDetailObat" action="<?php echo base_url();?>/obat/detail" class="form-horizontal">
					<div class="row">
						<div class="col-4">
							<div class="form-group mb-2">
								<label>Batch</label>
								<input type="hidden" name="id_obat" value="">
								<input type="hidden" name="id_detail" value="">
								<input type="text" class="form-control form-control-sm col-12" name="batch" value="">
								<div id="error-batch" class="invalid-feedback"></div>
							</div>
						</div>
						<div class="col-4">
							<div class="form-group mb-2">
								<label >Expired</label>
								<input type="text" class="form-control form-control-sm col-6" name="kadaluarsa" value="">
								<div id="error-kadaluarsa" class="invalid-feedback"></div>
							</div>
						</div>
						<div class="col-4">
							<div class="form-group mb-2">
								<label >Stok</label>
								<input type="text" class="form-control form-control-sm col-5" name="stok" value="">
								<div id="error-stok" class="invalid-feedback"></div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-12">
							<button type="submit" class="btn btn-block btn-outline-primary btn-xs">Simpan</button>
						</div>
					</div>
			 </form>
			</div>
		</div>
		<div class="row">
			<div class="col-12">
					<table class="table table-hover table-sm table-bordered">
					  <thead>
						<tr>
						  <th>Batch</th>
						  <th>Expired</th>
						  <th>Stok</th>
						  <th class="text-center">Aksi</th>
						</tr>
					  </thead>
					  <tbody>
					  <?php foreach($row as $data):?>
						<tr>
						  <td class="text-left"><?=$data["batch"]?></td>
						  <td class="text-left"><?=date("d-m-Y",strtotime($data["kadaluarsa"]))?></td>
						  <td class="text-left"><?=$data["stok"]?></td>
						  <td class="text-center">
							<button type="button" id="update-detail-<?=$data->id?>"   data-id="<?=$data["id"]?>" data-id_obat="<?=$data["id_obat"]?>" data-batch="<?=$data["batch"]?>" data-kadaluarsa="<?=date("d-m-Y",strtotime($data["kadaluarsa"]))?>" data-stok="<?=$data["stok"]?>" data-href="<?=base_url()?>/obat/ubah-detail?id=<?=$data->id?>" class="edit-detail btn btn-outline-info btn-flat btn-xs"><i class="fa fa-edit"></i> Edit</button>
							<button type="button" class="btn btn-outline-danger btn-flat btn-xs" 
							data-toggle="modal"
							href="#modal-delete-detail"
							data-id="<?=$data->id?>">
									<i class="fa fa-trash"></i> Hapus
							</button>		
						  </td>
						</tr>
						<?php endforeach;?>
					  </tbody>
					</table>
			</div>
		</div>
	</div>
