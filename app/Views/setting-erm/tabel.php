<?php
helper('klinik_helper');
?>
<div class="card">
	  <div class="card-body table-responsive p-0" style="height: 400px;">
		<table class="table table-head-fixed table-hover text-nowrap table-sm text-nowrap table-bordered">
		  <thead>
			<tr>
			  <th>No Registrasi</th>
			  <th>Tanggal</th>
			  <th>Nama</th>
			  <th class="text-center">Aksi</th>
			</tr>
		  </thead>
		  <tbody>
			<?php if(count($reg) > 0):?>
				<?php foreach($reg as $data):?>
				<tr>
				  <td class="align-middle"><?php echo $data->no_reg;?></td>
				  <td class="align-middle"><?php echo $data->tanggal;?></td>
				  <td class="align-middle"><?php echo $data->nama;?></td>
				  <td class="text-center">
					<?php if(isset($data->lunas)):?>
					<?php if($data->lunas == "lunas"):?>
					<button type="button" class="btn btn-outline-danger btn-flat btn-xs" 
					data-toggle="modal"
					href="#modal-delete"
					data-id="<?php echo $data->no_reg;?>">
							<i class="fa fa-folder-open"></i>&nbsp Buka
					</button>
					<?php endif;?>
					<?php endif;?>
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