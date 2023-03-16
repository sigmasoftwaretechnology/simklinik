<?php
helper('klinik_helper');
?>
<div class="card">
	  <div class="card-body table-responsive p-2" style="height: 400px;">
		<table class="table table-head-fixed table-hover text-nowrap table-sm text-nowrap table-bordered">
		  <thead>
			<tr>
			<th>Poli</th>
						<th>Status</th>
			<th>No Antrian Berjalan</th>
			  <th class="text-center">Aksi</th>
			</tr>
		  </thead>
		  <tbody>
			<?php if(count($antrian) > 0):?>
				<?php foreach($antrian as $data):?>
				<tr>
				<td class="align-middle"><?php echo $data->poli;?></td>
				<td class="align-middle">
					<?php if( $data->aktif == "yes"):?>	
						Tampil
					<?php else:?>
						Tidak Tampil	
					<?php endif;?>	
				</td>
				<td class="align-middle"><?php echo $data->no_antrian;?></td>
				<td class="text-center">
					<?php if($data->aktif == "yes"):?>
					<a
					data-toggle="modal"
					href="#modal-delete"
					data-id="<?php echo $data->_id;?>">
							<img src="<?php echo base_url(); ?>/assets/img/icon/switch-off.png">
					</a>
					<?php else:?>
					<a
					data-toggle="modal"
					href="#modal-open"
					data-id="<?php echo $data->_id;?>">
							<img src="<?php echo base_url(); ?>/assets/img/icon/switch-on.png">
					</a>
					<?php endif;?>
					<a onclick="resetNomor(this)"
					data-id="<?php echo $data->_id;?>">
							<img src="<?php echo base_url(); ?>/assets/img/icon/redo.png">
					</a>
				  </td>
				</tr>
				<?php endforeach;?>
			<?php endif;?>
		  </tbody>
		</table>
	  </div>
	  <!-- /.card-body -->
	</div>
	<!-- /.card -->