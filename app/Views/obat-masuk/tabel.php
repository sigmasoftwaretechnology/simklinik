<div class="card">	  
	<div class="card-body p-0">
		<table class="table table-hover table-sm table-bordered">
		  <thead>
			<tr>
			  <th>No Trans</th>
			  <th>Tanggal</th>
			  <th>Total</th>
			  <th>Jumlah Bayar</th>
			  <th>Kembali</th>
			  <th>Input By</th>
			</tr>
		  </thead>
		  <tbody>
			<?php foreach($reg as $data):?>
			<tr data-widget="expandable-table" aria-expanded="false">
			  <td class="text-left"><?=$data->no_transaksi?></td>
			  <td class="text-left"><?=$data->tanggal?></td>
			  <td class="text-left"><?="Rp ".number_format($data->total_bayar, 0, ',', '.')?></td>
			  <td class="text-left"><?="Rp ".number_format($data->jumlah_bayar, 0, ',', '.')?></td>
			  <td class="text-left"><?="Rp ".number_format($data->kembali, 0, ',', '.')?></td>
			  <td class="text-left"><?=$data->input_obat_masuk?></td>
			</tr>
			<tr class="expandable-body">
				<td colspan="6">
					<div class="row">
						<div class="col-6">
							<table class="table table-hover table-sm table-bordered">
								<thead>
									<tr>
										<th>Obat</th>
										<th>Batch</th>
										<th>Jumlah</th>
										<th>Expired</th>
										<th>Harga</th>
										<th>Total</th>
									</tr>
								</thead>
								<tbody>
									<?php foreach($data->detail_obat as $dtlObat):?>
										<tr>
											<td class="text-left"><?=$dtlObat->nama_obat?></td>
											<td class="text-left"><?=$dtlObat->batch?></td>
											<td class="text-left"><?=$dtlObat->expired?></td>
											<td class="text-left"><?=$dtlObat->jumlah?></td>
											<td class="text-left"><?="Rp ".number_format($dtlObat->harga, 0, ',', '.')?></td>
											<td class="text-left"><?="Rp ".number_format($dtlObat->total, 0, ',', '.')?></td>
										</td>
									<?php endforeach;?>
								</tbody>
							</table>
						</div>
					</div>
					<!--<div class="row">
						<div class="col-3">
							<button type="button" id="detail-<?=$data->no_transaksi?>" data-href="<?=base_url()?>/farmasi/resep-bebas/edit?reg=<?=$data->no_transaksi?>" data-toggle="modal" data-target="#modal-form-detail" class="btn btn-block btn-outline-danger btn-xs"><i class="fa fa-edit"></i> Edit</button>
						</div>
						<div class="col-3">
							<button type="button" id="cetak-invoice" class="btn btn-block btn-outline-success btn-xs">Cetak Kwitansi</button>
						</div>
					</div>-->
				</td>
			</tr>
			<?php endforeach;?>
		  </tbody>
		</table>
	  <!-- /.card-body -->
	</div>
</div>
	<!-- /.card -->