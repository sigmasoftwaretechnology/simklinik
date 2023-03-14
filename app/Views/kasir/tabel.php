<div class="card">	  
	<div class="card-body p-0">
		<table class="table table-hover table-sm table-bordered">
		  <thead>
			<tr>
			  <th>Registrasi</th>
			  <th>RM</th>
			  <th>Nama Pasien</th>
			  <th>Umur</th>
			  <th class="text-center">Aksi</th>
			</tr>
		  </thead>
		  <tbody>
			<?php foreach($reg as $data):?>
			<?php
			$kelas = "";
			if($data->lunas !== ""){
				$kelas = 'class="table-success"';
			}
			?>
			<tr <?=$kelas;?>>
			  <td class="text-left"><?=$data->no_reg?></td>
			  <td class="text-left"><?=$data->no_rm?></td>
			  <td class="text-left"><?=$data->nama?></td>
			  <td class="text-left"><?=$data->umur?></td>
			  <td class="text-center">
				<button type="button" id="detail-<?=$data->no_reg?>" data-href="<?=base_url()?>/keuangan/kasir/detail?reg=<?=$data->no_reg?>" data-toggle="modal" data-target="#modal-form-detail" class="btn btn-outline-success btn-flat btn-xs"><i class="fa fa-edit"></i> Detail</button>				
			  </td>
			</tr>
			<?php endforeach;?>
		  </tbody>
		</table>
	  <!-- /.card-body -->
	</div>
</div>
	<!-- /.card -->