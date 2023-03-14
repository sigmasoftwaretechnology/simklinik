<div class="card">	  
	<div class="card-body p-0">
		<table class="table table-hover table-sm table-bordered">
		  <thead>
			<tr>
			  <th>Nama</th>
			  <th>Alamat</th>
			  <th>Telp</th>
			  <th class="text-center">Aksi</th>
			</tr>
		  </thead>
		  <tbody>
		  <?php if(count($supplier) > 0):?>
			<?php foreach($supplier as $data):?>
			<tr>
			  <td class="text-left"><?=$data->nama?></td>
			  <td class="text-left"><?=$data->alamat?></td>
			  <td class="text-left"><?=$data->telp?></td>
			  <td class="text-center">
				<button type="button" id="update-<?=$data->_id?>" data-href="<?=base_url()?>/farmasi/supplier/ubah?id=<?=$data->_id?>" data-toggle="modal" data-target="#modal-form-baru" class="btn btn-outline-info btn-flat btn-xs"><i class="fa fa-edit"></i> Edit</button>
				<button type="button" class="btn btn-outline-danger btn-flat btn-xs" 
				data-toggle="modal"
				href="#modal-delete"
				data-id="<?=$data->_id?>">
						<i class="fa fa-trash"></i> Hapus
				</button>		
			  </td>
			</tr>
			<?php endforeach;?>
			<?php endif;?>
		</tbody>
		</table>
	  <!-- /.card-body -->
	</div>
</div>
	<!-- /.card -->