<div class="card">
	  <div class="card-body table-responsive p-2" style="height: 900px;">
		<table class="table table-head-fixed table-hover text-nowrap table-sm text-nowrap table-bordered">
		  <thead>
			<tr>
			  <th style="width:3%">No</th>
						<th align="center" style="width:5%"></th>
			  <th>Nama</th>
			  <th>Tarif</th>
			</tr>
		  </thead>
		  <tbody>
			<?php $no=1;foreach($row as $data):?>
			<tr>
			<td class="align-middle"><?=$no?></td>
						<td class="text-center">
				<a id="update-<?=$data->id?>" data-href="<?=base_url()?>/rekam-medis/tindakan/ubah?id=<?=$data->id?>" data-toggle="modal" data-target="#modal-form-baru"><img src="<?php echo base_url(); ?>/assets/img/icon/edit.png"></a>
				<a data-toggle="modal"
				href="#modal-delete"
				data-id="<?=$data->id?>"><img src="<?php echo base_url(); ?>/assets/img/icon/delete.png"></a>				  
			</td>

			  <td class="text-left"><?=$data->nama?></td>
			  <td class="text-right"><?="Rp ".number_format($data->tarif, 0, ',', '.')?></td>
			</tr>
			<?php $no++;endforeach;?>
		  </tbody>
		</table>
	  </div>
	  <!-- /.card-body -->
	</div>
	<!-- /.card -->