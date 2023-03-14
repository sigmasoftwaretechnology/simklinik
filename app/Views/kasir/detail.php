<div class="modal-header">
    Detail Resep
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
	<div class="card-body">
		<div class="row">
			<div class="col-9">
				<div class="card card-outline card-success">
					<div class="card-header">
						<h3 class="card-title">Invoice</h3>
					</div>
					<div class="card-body">
						<div class="row invoice-info">
							<div class="col-sm-4 invoice-col">
							<b>No RM :</b> <span id="rm_pasien"><?=$dataRegis->no_rm?></span><br>
							<b>Transaksi No :</b> <span id="no_reg"><?=$dataRegis->no_reg?></span><br>
							<b>Nama Pasien :</b> <?= $dataRegis->nama?><br>
							<b>Tanggal :</b> <?= $dataRegis->tanggal?>
							</div>
						</div>
						<div class="row">
							<div class="col-12">
								<table class="table table-hover table-sm table-bordered">
									<thead>
									<tr>
										<th><strong>Tindakan</strong></th>
										<th><strong>Tarif</strong></th>
									</tr>
									</thead>
									<tbody>
									<?php 
									$totTindakan = 0;
									if(isset($dataRegis->assessment->tindakan)):
									foreach($dataRegis->assessment->tindakan as $tindakan):
									$totTindakan = $totTindakan+$tindakan->tarif_tindakan;
									?>
									<tr>
										<td><?=$tindakan->nama_tindakan?></td>
										<td style="text-align:right"><?="Rp " . number_format($tindakan->tarif_tindakan,2,',','.')?></td>
									</tr>
									<?php 
									endforeach;
									?>
									<tr>
										<td>Total</td>
										<td style="text-align:right"><?="Rp " . number_format($totTindakan,2,',','.')?></td>
									</tr>

									<?php
									endif;
									?>
									</tbody>
								</table>
							</div>
							<div class="col-12">
								<table class="table table-hover table-sm table-bordered">
									<thead>
									<tr>
										<th><strong>Obat</strong></th>
										<th><strong>Qty</strong></th>
										<th><strong>Harga</strong></th>
										<th><strong>Total</strong></th>
									</tr>
									</thead>
									<tbody>
									<?php 
									$totObat = 0;
									if(isset($dataRegis->resep_obat)):
									foreach($dataRegis->resep_obat as $resepObat):
									$totObat = $totObat+($resepObat->harga*$resepObat->jumlah);
									?>
									<tr>
										<td><?=$resepObat->nama_obat?></td>
										<td><?=$resepObat->jumlah?></td>
										<td style="text-align:right"><?="Rp " . number_format($resepObat->harga,2,',','.')?></td>
										<td style="text-align:right"><?="Rp " . number_format($resepObat->harga*$resepObat->jumlah,2,',','.')?></td>
									</tr>
									<?php 
									endforeach;
									?>
									<tr>
										<td colspan="3">Grand Total</td>
										<td style="text-align:right"><?="Rp " . number_format($totObat,2,',','.')?></td>
									</tr>
									<?php
									endif;
									?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-3">
				<div class="card card-outline card-success">
						<div class="card-header">
							<h3 class="card-title">Pembayaran</h3>
						</div>
						<div class="card-body">
							<form id="frm-pembayaran" action="<?php echo base_url();?>/keuangan/kasir/save-pembayaran" method="POST">
								<div class="row">
									<div class="col-12">
										<div style="color:'#dddddd';"><i>Total pembayaran : <?="Rp " . number_format($totTindakan+$totObat,0,',','.')?><input type="hidden" id="total-bayar" value="<?=$totTindakan+$totObat?>"></i></div>
									</div>
								</div>
								<?php 
									if(!isset($dataRegis->lunas) || $dataRegis->lunas == ""):
								?>
								<div class="row mt-2">
									<div class="col-12">
									  <div class="form-group">
										<label class="mb-0">Jumlah Bayar</label>
										<input type="text" id="jumlah-bayar" class="form-control form-control-sm" placeholder="Jumlah" autocomplete="off">
									  </div>
									</div>
								</div>
								<div class="row">
									<div class="col-12">
										<div style="color:'#dddddd';"><i>Kembali : Rp <span id="kembali-rupiah">0</span><input type="hidden" id="kembali"></i></div>
									</div>
								</div>
								<?php else:?>
								<div class="row">
									<div class="col-12">
										<div style="color:red;"><i>Sudah di bayar</i></div>
									</div>
								</div>
								<?php 
									endif;
								?>
								<?php 
									if(!isset($dataRegis->lunas) || $dataRegis->lunas == ""):
								?>
								<div id="btn-grup">
								<div class="row">
									<div class="col-12">
										<button type="button" id="simpan-pembayaran" class="btn btn-block btn-outline-success btn-xs">Simpan Pembayaran</button>
									</div>
								</div>
								<?php else:?>
								<div class="row">
									<div class="col-12">
										<button type="button" id="cetak-invoice" class="btn btn-block btn-outline-success btn-xs">Cetak Kwitansi</button>
									</div>
								</div>
								<?php 
									endif;
								?>
								</div>
							</form>
						</div>
				</div>
			</div>
		</div>
	</div>
