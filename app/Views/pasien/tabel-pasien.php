<div class="card">
	  <div class="card-body table-responsive p-0" style="height: 400px;">
		<table class="table table-head-fixed table-hover text-nowrap table-sm text-nowrap table-bordered">
		  <thead>
			<tr>
			  <th>No RM</th>
			  <th>No BPJS</th>
			  <th>Nama</th>
			  <th>Alamat</th>
			  <th>Telp</th>
			  <th class="text-center">Aksi</th>
			</tr>
		  </thead>
		  <tbody>
			<?php foreach($row as $data):?>
			<tr>
			  <td class="align-middle"><?=$data->no_rm?></td>
			  <td class="align-middle"><?=$data->no_bpjs?></td>
			  <td class="align-middle"><?=$data->nama?></td>
			  <td class="align-middle"><?=$data->alamat?></td>
			  <td class="align-middle"><?=$data->telp?></td>
			  <td class="text-center">
				<button type="button" id="update-<?=$data->id?>" data-href="<?=base_url()?>/pasien/ubah?id=<?=$data->id?>" data-toggle="modal" data-target="#modal-form-pasien" class="btn btn-outline-info btn-flat btn-xs"><i class="fa fa-edit"></i> Edit</button>
				<button type="button" class="btn btn-outline-danger btn-flat btn-xs" 
				data-toggle="modal"
				href="#modal-delete"
				data-id="<?=$data->id?>">
						<i class="fa fa-trash"></i> Hapus
				</button>	
				<a type="button" href="<?=base_url()?>/pasien/cetak-kartu?id=<?=$data->id?>" target="_blank" class="btn btn-outline-warning btn-flat btn-xs"><i class="fa fa-id-card"></i> Cetak Kartu</a>		  				
			  </td>
			</tr>
			<?php endforeach;?>
		  </tbody>
		</table>
	  </div>
	  <!-- /.card-body -->
	</div>
	<!-- /.card -->