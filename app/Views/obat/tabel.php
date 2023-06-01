<div class="card">	  
	<div class="card-body p-2">
		<table class="table table-hover table-sm table-bordered">
		  <thead>
			<tr>
			  <th style="width:3%">No</th>
				<th align="center" style="width:5%"></th>
			  <th>Nama</th>
			  <th>Satuan</th>
			  <th>Supplier</th>
			  <th>Harga Pokok</th>
			  <th>Harga</th>
			  <th>Stok</th>
			</tr>
		  </thead>
		  <tbody>
		  	<?php if(count($obat) > 0):?>
			<?php $no=1;foreach($obat as $data):?>
			<tr>
			  <td class="text-left"><?=$no++?></td>
			  			  <td class="text-center">
			  	<a  id="update-<?=$data->_id?>" data-href="<?=base_url()?>/farmasi/obat/ubah?id=<?=$data->_id?>" data-toggle="modal" href="#modal-form-baru"><img src="<?php echo base_url(); ?>/assets/img/icon/edit.png"></a>
            	<a  data-toggle="modal" href="#modal-delete" data-id="<?php echo $data->_id;?>"><img src="<?php echo base_url(); ?>/assets/img/icon/delete.png"></a>
			  </td>
			  <td class="text-left"><?=$data->nama?></td>
			  <td class="text-left"><?=$data->satuan?></td>
			  <td class="text-left"><?=$data->supplier?></td>
			  <td class="text-left"><?="Rp " . number_format($data->harga_pokok,2,',','.')?></td>
			  <td class="text-left"><?="Rp " . number_format($data->harga,2,',','.')?></td>
			  <td class="text-left">
				<?php
				$stok = 0;
				foreach($data->batch as $batch){
					$stok = $stok+(int)$batch->stok;
				}
				echo $stok;
				?>	
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