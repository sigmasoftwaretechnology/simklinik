<?php
helper('klinik_helper');
?>
<div class="card">
	  <div class="card-body table-responsive p-0" style="height: 400px;">
		<table class="table table-head-fixed table-hover text-nowrap table-sm text-nowrap table-bordered">
		  <thead>
			<tr>
			<th>Poli</th>
			<th>No Antrian</th>
			<th>Status</th>
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
					<button type="button" class="btn btn-outline-danger btn-flat btn-xs" 
					data-toggle="modal"
					href="#modal-delete"
					data-id="<?php echo $data->_id;?>">
							<i class="fa fa-folder-open"></i>&nbsp Non Aktifkan
					</button>
					<?php else:?>
					<button type="button" class="btn btn-outline-success btn-flat btn-xs" 
					data-toggle="modal"
					href="#modal-open"
					data-id="<?php echo $data->_id;?>">
							<i class="fa fa-folder-open"></i>&nbsp Aktifkan
					</button>
					<?php endif;?>
					<button type="button" class="btn btn-outline-primary btn-flat btn-xs" onclick="resetNomor(this)"
					data-id="<?php echo $data->_id;?>">
							<i class="fa fa-folder-open"></i>&nbsp Reset Nomor
					</button>
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