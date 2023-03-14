<div class="card">
	  <div class="card-body table-responsive p-0">
		<table class="table table-head-fixed table-hover text-nowrap table-sm text-nowrap table-bordered">
		  <thead>
			<tr>
			  <th>Nama</th>
			  <th>Tarif</th>
			  <th class="text-center">Aksi</th>
			</tr>
		  </thead>
		  <tbody>
			<?php foreach($row as $data):?>
			<tr>
			  <td class="text-left"><?=$data->nama?></td>
			  <td class="text-right"><?="Rp ".number_format($data->tarif, 0, ',', '.')?></td>
			  <td class="text-center">
				<button type="button" id="update-<?=$data->id?>" data-href="<?=base_url()?>/rekam-medis/tindakan/ubah?id=<?=$data->id?>" data-toggle="modal" data-target="#modal-form-baru" class="btn btn-outline-info btn-flat btn-xs"><i class="fa fa-edit"></i> Edit</button>
				<button type="button" class="btn btn-outline-danger btn-flat btn-xs" 
				data-toggle="modal"
				href="#modal-delete"
				data-id="<?=$data->id?>">
						<i class="fa fa-trash"></i> Hapus
				</button>				  
			  </td>
			</tr>
			<?php endforeach;?>
		  </tbody>
		</table>
	  </div>
	  <!-- /.card-body -->
	</div>
	<!-- /.card -->