<div class="card">	  
	<div class="card-body p-0">
		<table class="table table-hover table-sm table-bordered">
		  <thead>
			<tr>
			  <th>No Trans</th>
			  <th>Tanggal</th>
			  <th>Total</th>
			  <th class="text-center">Aksi</th>
			</tr>
		  </thead>
		  <tbody>
			<?php foreach($reg as $data):?>
			<tr>
			  <td class="text-left"><?=$data->no_transaksi?></td>
			  <td class="text-left"><?=$data->tanggal?></td>
			  <td class="text-left"><?="Rp ".number_format($data->total_bayar, 0, ',', '.')?></td>
			  <td class="text-center">
				<button type="button" id="detail-<?=$data->no_transaksi?>" data-href="<?=base_url()?>/farmasi/resep-bebas/detail?reg=<?=$data->no_transaksi?>" data-toggle="modal" data-target="#modal-form-detail" class="btn btn-outline-success btn-flat btn-xs"><i class="fa fa-edit"></i> Edit</button>				
			  </td>
			</tr>
			<?php endforeach;?>
		  </tbody>
		</table>
	  <!-- /.card-body -->
	</div>
</div>
	<!-- /.card -->