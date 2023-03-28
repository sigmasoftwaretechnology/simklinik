<div class="card">	  
	<div class="card-body p-2">
		<table class="table table-hover table-sm table-bordered">
		  <thead>
			<tr>
			  <th style="width:3%">No</th>
			  <th>Tanggal</th>
			  <th>Nama Obat</th>
			  <th>Jml. Keluar</th>
			</tr>
		  </thead>
		  <tbody>
		  	<?php if(count($lstObat) > 0):?>
			<?php $no=1;foreach($lstObat as $k => $data):?>
				<tr>
					<td class="text-left"><?=$no++?></td>
					<td class="text-left"><?=$data['tgl']?></td>
					<td class="text-left"><?=$k?></td>
					<td class="text-left"><?=$data['jml']?></td>
				</tr>
			<?php endforeach;?>
			<?php endif;?>
		  </tbody>
		</table>
	  <!-- /.card-body -->
	</div>
</div>
	<!-- /.card -->