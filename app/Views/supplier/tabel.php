<div class="card">	  
	<div class="card-body p-2">
		<table class="table table-hover table-sm table-bordered">
		  <thead>
			<tr>
			  <th style="width:3%">No</th>
				<th align="center" style="width:5%"></th>
			  <th>Nama</th>
			  <th>Alamat</th>
			  <th>Telp</th>
			  <th class="text-center">Aksi</th>
			</tr>
		  </thead>
		  <tbody>
		  <?php if(count($supplier) > 0):?>
			<?php $i=1;foreach($supplier as $data):?>
			<tr>
			<td class="align-middle"><?=$i?></td>
						  <td class="text-center">
				<a id="update-<?=$data->_id?>" data-href="<?=base_url()?>/farmasi/supplier/ubah?id=<?=$data->_id?>" data-toggle="modal" data-target="#modal-form-baru"><img src="<?php echo base_url(); ?>/assets/img/icon/edit.png"></a>
				<a data-toggle="modal" href="#modal-delete" data-id="<?=$data->_id?>"><img src="<?php echo base_url(); ?>/assets/img/icon/delete.png"></a>
			  </td>
			  <td class="text-left"><?=$data->nama?></td>
			  <td class="text-left"><?=$data->alamat?></td>
			  <td class="text-left"><?=$data->telp?></td>
			</tr>
			<?php $i++;endforeach;?>
			<?php endif;?>
		</tbody>
		</table>
	  <!-- /.card-body -->
	</div>
</div>
	<!-- /.card -->