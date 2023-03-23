<div class="card">	  
	<div class="card-body p-2">
		<table class="table table-hover table-sm table-bordered">
		  <thead>
			<tr>
			  <th style="width:3%">No</th>
			  <th>Tanggal</th>
			  <th>Nama Obat</th>
			  <th>Batch</th>
			  <th>Jml. Keluar</th>
			</tr>
		  </thead>
		  <tbody>
		  	<?php if(count($assessment) > 0):?>
			<?php $no=1;foreach($assessment as $data):?>
				<?php foreach($data->resep_obat as $dtObat):?>
					<tr>
					<td class="text-left"><?=$no++?></td>
					<td class="text-left"><?=$data->tanggal?></td>
					<td class="text-left"><?=$dtObat->nama_obat?></td>
					<td class="text-left"><?=$dtObat->batch_obat?></td>
					<td class="text-left"><?=$dtObat->jumlah?></td>
					</tr>
				<?php endforeach;?>
			<?php endforeach;?>
			<?php endif;?>
		  </tbody>
		</table>
	  <!-- /.card-body -->
	</div>
</div>
	<!-- /.card -->