<div class="card">	  
	<div class="card-body p-2">
		<table class="table table-hover table-sm table-bordered">
		  <thead>
			<tr>
			  <th style="width:3%">No</th>
				<th align="center" style="width:5%"></th>
			  <th>Registrasi</th>
			  <th>RM</th>
			  <th>Nama Pasien</th>
			  <th>Umur</th>
			</tr>
		  </thead>
		  <tbody>
			<?php $no=1;foreach($reg as $data):?>
			<?php
			$kelas = "";
			if($data->lunas !== ""){
				$kelas = 'class="table-success"';
			}
			?>
			<tr <?=$kelas;?>>
						  <td class="text-left"><?=$no++?></td>

				<td class="text-center">
				<a id="detail-<?=$data->no_reg?>" data-href="<?=base_url()?>/keuangan/kasir/detail?reg=<?=$data->no_reg?>" data-toggle="modal" data-target="#modal-form-detail"><img src="<?php echo base_url(); ?>/assets/img/icon/file.png"></a>				
			  </td>
			  <td class="text-left"><?=$data->no_reg?></td>
			  <td class="text-left"><?=$data->no_rm?></td>
			  <td class="text-left"><?=$data->nama?></td>
			  <td class="text-left"><?=$data->umur?></td>
			</tr>
			<?php endforeach;?>
		  </tbody>
		</table>
	  <!-- /.card-body -->
	</div>
</div>
	<!-- /.card -->